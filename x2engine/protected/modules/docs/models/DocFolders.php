<?php

/*****************************************************************************************
 * X2Engine Open Source Edition is a customer relationship management program developed by
 * X2Engine, Inc. Copyright (C) 2011-2015 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2ENGINE, X2ENGINE DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. P.O. Box 66752, Scotts Valley,
 * California 95067, USA. or at email address contact@x2engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 *****************************************************************************************/

/**
 * Description of DocFolders
 *
 * @package application.modules.docs.models
 */
class DocFolders extends CActiveRecord {
    
    public $module = 'docs';

    /**
     * Returns the static model of the specified AR class.
     * @return Docs the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'x2_doc_folders';
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'DocFolders', 'parentFolder'),
            'childFolders' => array(self::HAS_MANY, 'DocFolders', 'parentFolder'),
            'childDocs' => array(self::HAS_MANY, 'Docs', 'folderId'),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, visibility', 'required'),
            array('parentFolder', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, parentFolder', 'safe', 'on' => 'search'),
        );
    }
    
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name);
        $criteria->compare('parentFolder', $this->parentFolder);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
    
    public function behaviors(){
        return array(
            'X2TimestampBehavior' => array('class' => 'X2TimestampBehavior'),
            'permissions' => array('class' => Yii::app()->params->modelPermissions),
        );
    }
    
    public function beforeSave(){
        if(empty($this->createdBy)){
            $this->createdBy = Yii::app()->user->getName();
        }
        $this->updatedBy = Yii::app()->user->getName();
        return parent::beforeSave();
    }
    
    public function beforeDelete(){
        $this->deleteRecursive();
        return parent::beforeDelete();
    }

    public static function getTemplatesFolderContents() {
        $model = DocFolders::model();
        $model->id = -1;
        $contents = array(0 => $model->createFileSystemObject(0, 'parent', null));
        $index = 1;
        $children = $model->getChildren('templates');
        foreach ($children['folders'] as $folder) {
            $contents[$index] = $model->createFileSystemObject($index, 'folder', $folder);
            $index++;
        }
        foreach ($children['docs'] as $doc) {
            $contents[$index] = $model->createFileSystemObject($index, 'doc', $doc);
            $index++;
        }
        return new CArrayDataProvider($contents, array(
            'id' => 'root-folder-contents',
            'pagination' => array(
                'pageSize' => Profile::getResultsPerPage(),
            )
        ));
    }

    public static function getRootFolderContents() {
        $model = DocFolders::model();
        $contents = array(0 => $model->createFileSystemObject(0, 'templates', null));
        $index = 1;
        $children = $model->getChildren('root');
        foreach ($children['folders'] as $folder) {
            $contents[$index] = $model->createFileSystemObject($index, 'folder', $folder);
            $index++;
        }
        foreach ($children['docs'] as $doc) {
            $contents[$index] = $model->createFileSystemObject($index, 'doc', $doc);
            $index++;
        }
        return new CArrayDataProvider($contents, array(
            'id' => 'root-folder-contents',
            'pagination' => array(
                'pageSize' => Profile::getResultsPerPage(),
            )
        ));
    }
    
    public function checkRecursiveDeletePermissions(){
        $deletePermission = Yii::app()->controller->checkPermissions($this, 'delete');
        if (!$deletePermission) {
            return $deletePermission;
        }
        foreach($this->childDocs as $doc){
            $deletePermission = $deletePermission && Yii::app()->controller->checkPermissions($doc, 'delete');
            if(!$deletePermission){
                break;
            }
        }
        if($deletePermission){
            foreach($this->childFolders as $folder){
                $deletePermission = $deletePermission && $folder->checkRecursiveDeletePermissions();
                if(!$deletePermission){
                    break;
                }
            }
        }
        return $deletePermission;
    }
    
    public function deleteRecursive(){
        foreach($this->childDocs as $doc){
            $doc->delete();
        }
        foreach($this->childFolders as $folder){
            $folder->delete();
        }
    }

    public function getPath() {
        $pathArr = $this->getPathArr();
        return '/' . implode('/', array_reverse($pathArr));
    }

    private function getPathArr() {
        if (!is_null($this->parent)) {
            return array_merge(array($this->name), $this->parent->getPathArr());
        } else {
            return array($this->name);
        }
    }

    public function getContents() {
        $contents = array(0 => $this->createFileSystemObject(0, 'parent', null));
        $index = 1;
        $children = $this->getChildren();
        foreach ($children['folders'] as $folder) {
            $contents[$index] = $this->createFileSystemObject($index, 'folder', $folder);
            $index++;
        }
        foreach ($children['docs'] as $doc) {
            $contents[$index] = $this->createFileSystemObject($index, 'doc', $doc);
            $index++;
        }
        return new CArrayDataProvider($contents, array(
            'id' => $this->id . '-folder-contents',
            'pagination' => array(
                'pageSize' => Profile::getResultsPerPage(),
            )
        ));
    }
    
    private function getChildren($option = null) {
        $children = array('folders' => array(), 'docs' => array());
        $folderCriteria = new CDbCriteria();
        if ($option === 'root') {
            $folderCriteria->condition = 'parentFolder IS NULL AND id > 0';
        } else {
            $folderCriteria->compare('parentFolder', $this->id);
        }
        $folderCriteria->mergeWith($this->getAccessCriteria());
        $folderCriteria->order = 'name ASC';
        $children['folders'] = DocFolders::model()->findAll($folderCriteria);

        $docsCriteria = new CDbCriteria();
        $doc = Docs::model();
        if ($option === 'root') {
            $docsCriteria->condition = 'folderId IS NULL AND type NOT IN ("email","quote")';
        } elseif($option === 'templates'){
            $docsCriteria->condition = 'folderId IS NULL AND type IN ("email","quote")';
        } else {
            $docsCriteria->compare('folderId', $this->id);
        }
        $docsCriteria->mergeWith($doc->getAccessCriteria());
        $docsCriteria->order = 'name ASC';
        $children['docs'] = Docs::model()->findAll($docsCriteria);

        return $children;
    }
    
    private function createFileSystemObject($id, $type, $object) {
        $options = array(
            'id' => $id,
            'parentId' => $this->id,
            'type' => null,
            'objId' => null,
            'name' => null,
            'createdBy' => null,
            'lastUpdated' => null,
            'updatedBy' => null,
            'visibility' => null,
        );
        if ($type === 'parent') {
            $options['objId'] = is_null($this->parentFolder) ? null : $this->parentFolder;
            $options['type'] = 'folder';
            $options['name'] = '..';
        } elseif ($type === 'templates') {
            $options['type'] = 'folder';
            $options['objId'] = -1;
            $options['name'] = Yii::t('docs', 'Templates');
        } else {
            $options['type'] = $type;
            $options['objId'] = $object->id;
            $options['name'] = $object->name;
            $options['createdBy'] = $object->createdBy;
            $options['lastUpdated'] = $object->lastUpdated;
            $options['updatedBy'] = $object->updatedBy;
            $options['visibility'] = $object->visibility;
        }
        return new FileSystemObject($options);
    }

}
