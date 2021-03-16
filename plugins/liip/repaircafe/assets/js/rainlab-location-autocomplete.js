(function($) {
    // access LocationAutocomplete map function
    const getValueMap = $.fn.locationAutocomplete.Constructor.prototype.getValueMap
    // retrieve original mapping
    const valueMap = getValueMap();
    // flip values to match format: Streetname Number
    valueMap.short.inputStreet = valueMap.short.inputStreet.reverse() 
    // overwrite function with altered mapping
    $.fn.locationAutocomplete.Constructor.prototype.getValueMap = () => valueMap
})(jQuery)
