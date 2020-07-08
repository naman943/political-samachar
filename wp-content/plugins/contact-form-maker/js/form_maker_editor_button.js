(function() {
  tinymce.create('tinymce.plugins.Form_Maker_mce_fmc', {
    init : function(ed, url) {
      ed.addCommand('mceForm_Maker_mce_fmc', function() {
        ed.windowManager.open({
          file : form_maker_admin_ajax_fmc,
					width : 640 + ed.getLang('Form_Maker_mce_fmc.delta_width', 0),
					height : 385 + ed.getLang('Form_Maker_mce_fmc.delta_height', 0),
					inline : 1,
          title : 'Form'
				}, {
					plugin_url_fmc : url // Plugin absolute URL
				});
			});
      ed.addButton('Form_Maker_mce_fmc', {
        title : 'Insert Form Maker',
        cmd : 'mceForm_Maker_mce_fmc',
        image: url + '/images/form_maker_edit_but.png'
      });
    }
  });
  tinymce.PluginManager.add('Form_Maker_mce_fmc', tinymce.plugins.Form_Maker_mce_fmc);
})();