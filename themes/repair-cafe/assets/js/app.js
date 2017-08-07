$( document ).ready(function() {
    $('#eventSearch select[name="category"]').change(function() {
        this.form.submit();
    });
});
