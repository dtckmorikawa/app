/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.on( 'dialogDefinition', function( ev ) {
    // Take the dialog name and its definition from the event data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    // Check if the definition is from the dialog we're
    // interested in (the "Table" dialog).
    if ( dialogName == 'table' ) {
        // Get a reference to the "Table Info" tab.
        var infoTab = dialogDefinition.getContents( 'info' );
        txtWidth = infoTab.get( 'txtWidth' );
        txtWidth['default'] = '80%';
    }
});

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	config.defaultLanguage = 'ja';

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools','html5video' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		//{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Italic,Styles,Strike,HorizontalRule,SpecialChar,PasteFromWord';

	// Set the most common block elements.
	config.format_tags = 'p;h3';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;image:Link;link:advanced;link:target;link:upload';

	// Add plugin
	config.extraPlugins = 'html5video,widget,widgetselection,clipboard,lineutils,filebrowser,uploadimage,uploadwidget,filetools,notificationaggregator,notification,menu,contextmenu,liststyle';
};
