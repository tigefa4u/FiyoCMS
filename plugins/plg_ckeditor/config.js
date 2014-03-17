/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	CKEDITOR.config.allowedContent = true;
	config.protectedSource.push(/<\?[\s\S]*?\?>/g); // PHP Code
	config.protectedSource.push(/<code>[\s\S]*?<\/code>/gi); // Code tags
	config.filebrowserBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=files&dir=files';
	config.filebrowserImageBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=images&dir=images';
	config.filebrowserFlashBrowseUrl = '../plugins/plg_kcfinder/browse.php?type=flash&dir=flash';	
	config.toolbar = 'Full';
	config.toolbar_Full =
	[
		{ name: 'sourssce', items : [ 'Source'] },
		{ name: 'document', items : [ 'Templates','-','DocProps','Preview','Print' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'SpecialChar','Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		{ name: 'tools', items : [  'Maximize','ShowBlocks' ] },
		'/',

		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'justify', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table'] },
		{ name: 'insert2', items : [ 'PageBreak'] },
		'/',
		
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent'] },
		{ name: 'insert2', items : [ 'Blockquote','HorizontalRule' ] },
	];
	
	CKEDITOR.plugins.add('showtime',   //name of our plugin
{    
    requires: ['dialog'], //requires a dialog window
    init:function(a) {
  var b="showtime";
  var c=a.addCommand(b,new CKEDITOR.dialogCommand(b));
  c.modes={wysiwyg:1,source:1}; //Enable our plugin in both modes
  c.canUndo=true;
 
  //add new button to the editor
  a.ui.addButton("showtime",
  {
   label:'Show current time',
   command:b,
   icon:this.path+"showtime.png"   //path of the icon
  });
  CKEDITOR.dialog.add(b,this.path+"dialogs/ab.js") //path of our dialog file
  
 }
});
};
