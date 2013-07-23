<?php
// English messages

return array(
    //////////
    // menu //
    //////////
    'menu.home' => 'Home',
    'menu.photos' => 'Photos',
    'menu.contact' => 'Contact',
    'menu.activities' => 'Activities',
    'menu.shop' => 'Shop',
    'menu.logout' => 'Logout',
    'menu.dashboard' => 'Dashboard',
	'menu.more' => 'More',
    
    //////////
    // form //
    //////////
    
    // general
	'form.general.search' => 'Search',
	'form.general.filter' => 'Filter',
    'form.general.requiredFields' => 'Fields with a <span class="required">*</span> are required.',
    'form.general.captchaExplanation' => 'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.',
    'form.general.verifyCode' => 'Verification Code',
    'form.general.update' => 'Update',
    'form.general.save' => 'Save',
    'form.general.next' => 'Next',
    'form.general.new' => 'New',
    'form.general.add' => 'Add',
    'form.general.create' => 'Create',
    'form.general.close' => 'Close',
    'form.general.list' => 'List',
    'form.general.filterBy' => 'Filter by {type}',
    'form.general.listOf' => 'List of {attributes}',
    'form.general.newAttr' => 'New {attribute}',
    'form.general.updateAttr' => 'Update {attribute}',
    'form.general.createAttr' => 'Create {attribute}',
    'form.general.changesAutoSaved' => 'Any changes will automatically by saved.',
    'form.general.link' => 'Link',
    'form.general.label' => 'Label',
    'form.general.showingNumOf' => 'Showing {start}-{end} of {count} results.',
    'form.general.chooseFile' => 'Choose File',
    
    // login
    'form.login.login' => 'Login',
    'form.login.noAccountYet' => 'No account yet?',
    'form.login.registerHere' => 'Register here!',
    'form.login.rememberMe' => 'Remember me',
    'form.login.username' => 'Username',
    'form.login.password' => 'Password',
    'form.login.forgotPassword' => 'Forgot your password?',
    'form.login.invalidUsername' => 'Invalid username',
    'form.login.wrongCredentials' => 'Wrong credentials supplied.',
    'form.login.notActivated' => 'Your account has not been activated yet.',
    
    // register
    'form.register.register' => 'Register',
    'form.register.wrongAnswer' => 'Wrong answer',
    'form.register.weakPassword' => '{attribute} is weak. {attribute} must at least contain {min} characters and at least 1 number.',
    
    // recoverPassword
    'form.recoverPassword.failed' => 'Something went wrong when sending your new password',
    'form.recoverPassword.wrongAnswer' => 'Wrong answer.',
    
    // changePassword
    'form.changePassword.succes' => 'Your password has been updated.',
    'form.changePassword.wrongCurrentPassword' => 'Your current password is wrong.',
    
    // user
    'form.user.pwd_repeat' => 'Password (repeat)',
    'form.user.newPwd' => 'New Password',
    'form.user.newPwd_repeat' => 'New Password (repeat)',
    
    // contact
    'form.contact.contact' => 'Contact',
    'form.contact.contactUs' => 'Contact Us',
    'form.contact.subject' => 'Subject',
    'form.contact.body' => 'Body',
    
    // widgets
    'form.widgets.widget' => 'Widget',
    'form.widgets.widgets' => 'Widgets',
    'form.widgets.changesAutoSaved' => 'Any changes to the widgets will automatically be saved.',
    'form.widgets.new' => 'New widget',
    'form.widgets.selectWidgetType' => 'Select the type of the widget you want to add.',
    'form.widgets.amount' => 'Amount',
    'form.widgets.singleItem' => 'Single item',
    'form.widgets.type' => 'Type',
    'form.widgets.invalidItemForWidget' => 'Please select a valid item for this widget.',
    'form.widgets.notAllSaved' => 'Not all widgets were saved.',
    
    // navigation
    'form.navigation.subElement' => 'Sub Element',
    'form.navigation.removeMessage' => 'Are you sure you want to remove this element? All subelements will also be deleted.',
    'form.navigation.newElement' => 'New Element',
    'form.navigation.newLink' => 'New Link',
    
    ///////////////
    // dashboard //
    ///////////////
    'dashboard.dashboard' => 'Dashboard',
    
    // account
    'dashboard.account' => 'Account',
    'dashboard.account.connectToFacebook' => 'Connect to Facebook',
    
    // changePassword
    'dashboard.changePassword' => 'Change Password',
    
    // pages
    'dashboard.pages' => 'Pages',
    'dashboard.pages.navigation' => 'Navigation',
    'dashboard.pages.create' => 'New page',
    'dashboard.pages.listOfPages' => 'List of Pages',
    'dashboard.pages.update' => 'Update page',
    
    // items
    'dashboard.items' => 'Content',
    'dashboard.items.categories' => 'Categories',
    'dashboard.items.dummyItems' => 'DummyItems',
    'dashboard.items.news' => 'News',
    'dashboard.items.text' => 'Text items',
    
    // admin
    'dashboard.admin' => 'Administration',
    'dashboard.admin.rbam' => 'RBAM',
    
    ///////////
    // model //
    ///////////
    
    // general
    'model.general.id' => 'ID',
    'model.general.title' => 'Title',
    'model.general.author' => 'Author',
    'model.general.tag' => 'Tag',
    'model.general.tags' => 'Tags',
    'model.general.name' => 'Name',
    'model.general.dateCreated' => 'Creation Date',
    'model.general.dateChanged' => 'Latest Change',
    'model.general.content' => 'Content',
    'model.general.value' => 'Value',
    'model.general.label' => 'Label',
    'model.general.type' => 'Type',
    'model.general.parent' => 'Parent',
    
    // user
    'model.user.name' => 'Name',
    'model.user.mail' => 'E-Mail',
    'model.user.datereg' => 'Date of registration',
    'model.user.pwd' => 'Password',
    'model.user.secrq' => 'Secret question',
    'model.user.secra' => 'Secret answer',
    'model.user.gender' => 'Gender',
    'model.user.fbid' => 'Facebook ID',
    
    // page
    'model.page.columns' => 'Columns',
    
    // category
    'model.category.category' => 'Category',
    
    // navigation
    'model.navigation.route' => 'Route',
    
    // widget
    'model.widget.page' => 'Page',
    'model.widget.column' => 'Column',
    'model.widget.rowOrder' => 'Row Order',
    'model.widget.itemType' => 'Item Type',
    'model.widget.widgetType' => 'Widget Type',
    'model.widget.itemId' => 'Item ID',
    
    // items
    'model.items.navigation.navigation' => 'Navigation',
    'model.items.news.excerpt' => 'Excerpt',
    'model.items.file.extension' => 'Extension',
    'model.items.file.file' => 'File',
    
    //////////
    // enum //
    //////////
    
    // gender
    'enum.gender.male' => 'Male',
    'enum.gender.female' => 'Female',
    
    // item
    'enum.item.dummyItem' => 'DummyItem',
    'enum.item.dummyItems' => 'DummyItems',
    'enum.item.newsItem' => 'News Item',
    'enum.item.newsItems' => 'News',
    'enum.item.textItem' => 'Text Item',
    'enum.item.textItems' => 'Text Items',
    'enum.item.navigationItem' => 'Navigation Item',
    'enum.item.navigationItems' => 'Navigation Items',
    'enum.item.fileItem' => 'File Item',
    'enum.item.fileItems' => 'File Items',
    
    ///////////
    // error //
    ///////////
    
    'error.404' => 'The requested page does not exist.',
    'error.navigation.rootElementDoesNotExist' => 'The given navigation root element does not exist.',
    'error.somethingWentWrong' => 'Something went wrong, please try again later.',
);

?>