document.addEventListener('DOMContentLoaded', () => {
  const sheet = Array.from(document.styleSheets).find(s => s.ownerNode.id === 'tcdce-editor-css');
  const oldClass = '.tcdce-body';
  const newClass = '.wp-block-freeform.mce-content-body';
  if (sheet) {
    try {
      Array.from(sheet.cssRules || []).forEach((rule, index) => {
        if (rule.cssText.includes(oldClass)) {
          // 古いクラス名を新しいクラス名に置き換え
          const newCssText = rule.cssText.replace(new RegExp(oldClass, 'g'), newClass);
          // 古いスタイルルールを削除して新しいスタイルルールを追加
          sheet.deleteRule(index);
          sheet.insertRule(newCssText, index);
        }
      });
    } catch (e) {
      console.error("Access denied to stylesheet", e);
    }
  }
});