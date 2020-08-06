(function() {
    tinymce.PluginManager.add('mce_buttons', function( editor, url ) { // ID кнопки
        editor.addButton('mce_career_button', {  // ID кнопки
            text: '[Add Vacancies]', // Текст кнопки
            title: 'Add our vacancies', // Вспливаюча підказка
            icon: false, // Іконка TinyMCE
            onclick: function() {
                editor.insertContent('[careers_shortcode]'); // Вставляю шорткод в редактор
            }
        });
    });
})();