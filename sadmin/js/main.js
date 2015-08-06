'use strict';
function xjGrowl(response, newValue){
    response = response || 'Новое значение поля = ';
    $.jGrowl(response + newValue, {theme: 'lightness',header: "Состояние запроса:",life: 1500});
}
function xEdit(){
    $('.xeditAddDate').datepicker({
        format: "yyyy-mm-dd",
        language: "ru",
        autoclose: true
    });
    $('.xedit').editable({
        url: '/sadmin/save/',
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aCountry').editable({
        url: '/sadmin/save/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/country/name/name/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aPlace').editable({
        url: '/sadmin/save/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/place/name/name_alt/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aStreet').editable({
        url: '/sadmin/save/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/street/name/name/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aKinder').editable({
        url: '/sadmin/savemf/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/kindergarten/name/name/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aSchool').editable({
        url: '/sadmin/savemf/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/school/name/name/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aAcademy').editable({
        url: '/sadmin/savemf/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/academy/name/name/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aMother').editable({
        url: '/sadmin/savemf/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeaheadmf/mother/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.aFather').editable({
        url: '/sadmin/savemf/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeaheadmf/father/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
}

$(function() {
    $('body').on('click', '#addToReg', function(e){
        e.preventDefault();
        var aC = $('#address .aCountry').text(),
            aP = $('#address .aPlace').text(),
            aS = $('#address .aStreet').text(),
            aH = $('#address .aHouse').text(),
            aF = $('#address .aFlat').text(),
            aR = $('#address .aRoom').text();
        $.post('/sadmin/save/copyar/', {
            params: $(this).data('params'),
            aCountry: (aC === 'Empty')?'':aC,
            aPlace: (aP === 'Empty')?'':aP,
            aStreet: (aS === 'Empty')?'':aS,
            aHouse: (aH === 'Empty')?'':aH,
            aFlat: (aF === 'Empty')?'':aF,
            aRoom: (aR === 'Empty')?'':aR
        }, function(response, sValue) {
            xjGrowl(response, sValue);
            $('#regAddress .aCountry').text(aC).removeClass('editable-empty');
            $('#regAddress .aPlace').text(aP).removeClass('editable-empty');
            $('#regAddress .aStreet').text(aS).removeClass('editable-empty');
            $('#regAddress .aHouse').text(aH).removeClass('editable-empty');
            $('#regAddress .aFlat').text(aF).removeClass('editable-empty');
            $('#regAddress .aRoom').text(aR).removeClass('editable-empty');
        });
    })
    $("body").on('click', '.jedCheck', function() {
        $.post('/sadmin/save/check/', {
            params: $(this).data('params'),
            check: $(this).prop('checked')
        }, function(sValue) {
            $(this).prop('checked', function(i,val){return !val;});
            $.jGrowl('Новое значение поля = ' + sValue, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        });
    })
    $("body").on('click', '.jedCheckListAdd', function() {
        var pid = $('#pItemAdd').data('pid');
        $.post('/sadmin/save/list/people_id/', {
            pid: pid,
            params: $(this).data('params'),
            check: $(this).prop('checked')
        }, function(sValue) {
            $(this).prop('checked', function(i,val){return !val;});
            $.jGrowl('Новое значение поля = ' + sValue, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        });
    })
    xEdit();
});
