+function ($) {
    var DefaultButtons = {
        init: function () {
            $.oc.richEditorButtons = [
                'paragraphFormat',
                'quote',
                'bold',
                'italic',
                'align',
                'formatOL',
                'formatUL',
                'insertTable',
                'insertLink',
                'insertImage',
                'insertHR',
                'clearFormatting',
                'snippets',
                'fullscreen'
            ]
        }
    }

    $(document).on('render', function () {
        DefaultButtons.init()
    })
}(jQuery)
