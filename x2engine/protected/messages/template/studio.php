<?php
return array (
// Menu Text
'Manage Flows'=>'',
'Create Flow'=>'',
'X2Flow Automation Rules'=>'',

// Flow Editor Text
'Compare Attribute'=>'',
'Current User'=>'',
'Current Month'=>'',
'Day of Week'=>'',
'Day of Month'=>'',
'Time of Day'=>'',
'Current Time'=>'',
'User Logged In'=>'',
'On List'=>'',
'Add Attribute'=>'',

// Trigger Types
'Select a trigger'=>'',
'Action Overdue'=>'',
'Action Marked Incomplete'=>'',
'Campaign Email Clicked'=>'',
'Campaign Email Opened'=>'',
'Unsubscribed from Campaign'=>'',
'Campaign Web Activity'=>'',
'Newsletter Email Clicked'=>'',
'Newsletter Email Opened'=>'',
'Unsubscribed from Newsletter'=>'',
'Tag Added'=>'',
'Tag Removed'=>'',
'Record Updated'=>'',
'Record Viewed'=>'',
'User Signed In'=>'',
'User Signed Out'=>'',
'Contact Web Activity'=>'',

// Trigger Text
'Triggers when an action becomes overdue. Cronjob must be configured to trigger reliably.'=>'',
'Time Overdue (s)'=>'',
'Triggers when a contact clicks a tracking link in a campaign email.'=>'',
'Triggers when a contact opens or clicks on a tracking link in a campaign email.'=>'',
'Triggers when a contact clicks the "unsubscribe" link in a campaign email.'=>'',
'Triggered when a contact visits your webpage by clicking a link in a campaign email.'=>'',
'Triggers when a contact clicks a tracking link in a newsletter email (no contact record available).'=>'',
'Triggers when a contact opens or clicks on a tracking link in a newsletter email (no contact record available).'=>'',
'Triggers when a contact clicks the "unsubscribe" link in a newsletter email (no contact record available).'=>'',
'Triggered when a contact visits a webpage (no contact record available).'=>'',
'Triggers when a new record of the specified type is created.'=>'',
'Triggers when a record of specified type is deleted.'=>'',
'Triggered by adding one of these tags to a record.'=>'',
'Triggered when some updates a record of the the specified type.'=>'',
'Triggered when a user signs in to X2Engine.'=>'',
'Triggered when a user signs out of X2Engine.'=>'',
'Triggered when a contact visits a webpage'=>'',
'Triggers when a new contact fills out your web lead capture form.'=>'',

// Action Types
'Flow Actions'=>'',
'Remote API Call'=>'',
'Post to Activity Feed'=>'',
'Create Popup Notification'=>'',
'Create Record'=>'',
'Create Action for Record'=>'',
'Delete Record'=>'',
'Email Record'=>'',
'Email Contact'=>'',
'Add to List'=>'',
'Remove from List'=>'',
'Reassign Record'=>'',
'Add or Remove Tags'=>'',
'Update Record'=>'',
'Wait'=>'',

// Action Text
'Conditional Switch'=>'',
'Creates a fork in the automation flow based on your conditions.'=>'',
'Call a remote API by requesting the specified URL. You can specify the request type and any variables to be passed with the request. To improve performance, he request will be put into a job queue unless you need it to execute immediately.'=>'',
'GET'=>'',
'POST'=>'',
'PUT'=>'',
'DELETE'=>'',
'Creates an activity feed event.'=>'',
'Owner of Record'=>'',
'{Owner of Record}'=>'',
'Send a template or custom email to the specified address.'=>'',
'Creates a new action associated with the record that triggered this flow.'=>'',
'Permanently delete this record.'=>'',
'Send a template or custom email to this record\'s email address. Uses the assignee\'s email unless specified.'=>'',
'Add this record to a static list.'=>'',
'Remove this record from a static list.'=>'',
'Assign the record to a user or group, or automatically using lead routing.'=>'',
'Use Lead Routing'=>'',
'Enter a commna-separated list of tags to add to the record'=>'',
'Change one or more fields on an existing record.'=>'',
'Delay execution of the remaining steps until the specified time.'=>'',
'days'=>'',
'months'=>'',
'Current Timestamp'=>'',
'Flow configuration data appears to be corrupt.'=>'',
'You must configure a trigger event.'=>'',
'There must be at least one action in the flow.'=>'',
'Duration (s)'=>'',
'Create New Flow'=>'',
'Message'=>'',
'For'=>'',
'Post Type'=>'',
'Create Notification?'=>'',
'User Active?'=>'',
'Tags (optional)'=>'',
'seconds (recommended for formulas only)'=>'',
'All Trigger Logs'=>'',
'Trigger: '=>'',
'Execute Branch: '=>'',
'Trigger Log'=>'',
'Are you sure you want to delete all trigger logs?'=>'',
'Are you sure you want to permanently delete all trigger logs?'=>'',
'Triggered At'=>'',
'Log Output'=>'',
'View Log Output'=>'',
'Flow Name'=>'',
'Flow Trigger Logs'=>'',
'Cron Action Succeeded'=>'',
'Cron Action Failed'=>'',
'Viewing log file {file}'=>'',
'Show Trigger Logs'=>'',
'View Cron Log'=>'',
'Test Cron'=>'',
'Toggle Node Labels'=>'',
'Required flow item input missing'=>'',
'View created record: '=>'',
'View created action: '=>'',
'Flow item configuration error: No attributes added'=>'',
'View updated record: '=>'',
'User '=>'',
'Default Web Content'=>'',
'conditions not passed'=>'',
'Flow configuration data appears to be '=>'',
'There must be at least one action in the '=>'',
'View record: '=>'',
'Export Flow'=>'',
'Please click the button below to begin the export. Do not close this page until the export is finished.'=>'',
'You are currently exporting '=>'',
'Please click the link below to download the exported flow.'=>'',
'Upload a flow that has been exported using the X2Flow export tool.'=>'',
'Processes are not associated with records of this type'=>'',
'{recordName} are not associated with processes'=>'',
'Stage "{stageName}" started for {recordName}'=>'',
'Lead routing rules cannot be used with {type} records'=>'',
'Stage "{stageName}" reverted for {recordName}'=>'',
'Stage Comment'=>'',
'Stage "{stageName}" completed for {recordName}'=>'',
'Associated Record Type'=>'',
'the following condition did not pass: '=>'',
'a required parameter is missing'=>'',
'No tags on the record matched those in the tag trigger criteria.'=>'',
'No tags in the trigger criteria!'=>'',
'Tags parameter missing!'=>'',
'Match Probability'=>'',
'Invalid file type'=>'',
'Invalid file contents'=>'',
'Invalid flow'=>'',
'Export Workflow'=>'',
'Attributes:'=>'',
'Headers:'=>'',
'Add Header'=>'',
'Process: '=>'',
'Stage: '=>'',
'State: '=>'',
'X2Workflow Automation Rules'=>'',
'Create New Workflow'=>'',
'Upload a flow that has been exported using the X2Workflow export tool.'=>'',
'Warning: The url specified in your Remote API Call flow action points to the same server that X2Engine is hosted on. This could mean that this flow makes a request to X2Engine\'s API. Calling X2Engine\'s API from X2Flow is not advised since it could potentially trigger this flow, resulting in an infinite loop.'=>'',
'Requests cannot be made to X2Engine\'s API from X2Flow.'=>'',
'Remote API call succeeded'=>'',
'Remote API call failed!'=>'',
'Email could not be sent because at least one of the addressees has their "Do not email" attribute checked'=>'',
'List could not be found'=>'',
'The selected list does not contain records of this type'=>'',
'Related Record Type'=>'',
'Related Record Name'=>'',
'Log email?'=>'',
'Checking this box will cause the email to be attached to the recipient contact\'s record and enables email tracking.'=>'',
'Add "Do Not Email" link to email body?'=>'',
'Checking this box will cause a link to be appended to the email body which, when clicked, causes the contact\'s "Do Not Email" field to be checked. Note that any recipients specified in the Bcc or Cc lists will also be able to click this link.'=>'',
'Workflow stage actions must have an associated model.'=>'',
'Invalid value for field "User"'=>'',
'Flow item validation error: Invalid operator'=>'',
'Required flow item input missing: {optName} was left blank.'=>'',
'Invalid option value for {optionName}. Multiple values specified but only one is allowed.'=>'',
'Has Tags'=>'',
'The following condition did not pass: '=>'',
'Condition failed'=>'',
);