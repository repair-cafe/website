+function ($) {
    var DefaultButtons = {
        init: function () {
            $.oc.richEditorButtons = [
                'paragraphFormat',
                'bold',
                'italic',
                'align',
                'formatOL',
                'formatUL',
                'insertTable',
                'insertLink',
                'insertImage',
                'insertHR',
                'snippets',
                'clearFormatting',
                'fullscreen'
            ]
        }
    }

    $(document).on('render', function () {
        DefaultButtons.init()
    })
}(jQuery)
