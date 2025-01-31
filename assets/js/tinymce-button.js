(function () {
	if (!tcdQuicktagsL10n) return;

	// ビジュアルエディタにプルダウンメニューの追加
	tinymce.PluginManager.add('tcdce_button', function (editor, url) {
		var menus = [];

		for (let k in tcdQuicktagsL10n) {
			if (k !== 'pulldown_title' && typeof tcdQuicktagsL10n[k] === 'object') {
				menus.push({
					text: tcdQuicktagsL10n[k].display,
					onclick: function () {
						if (tcdQuicktagsL10n[k].tagStart && tcdQuicktagsL10n[k].tagEnd && editor.selection.getContent()) {
							editor.insertContent(tcdQuicktagsL10n[k].tagStart + editor.selection.getContent() + tcdQuicktagsL10n[k].tagEnd);
						} else if (tcdQuicktagsL10n[k].tag) {
							editor.insertContent(tcdQuicktagsL10n[k].tag);
						}
					}
				});
			}
		}

		editor.addButton('tcdce_button', {
			text: tcdQuicktagsL10n.pulldown_title.display,
			icon: false,
			type: 'menubutton',
			menu: menus
		});
	});
})();