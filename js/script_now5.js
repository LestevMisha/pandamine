$(document).ready(function () {
    $('.phpmc_buy').submit(function () {
        if(!$(this).data('ready')) {
            check($(this));
            return false;
        }
    });
    $('.select-group').change(function () {
        check($(this).parents('form'));
    });
    $('.input-promocode').change(function () {
        check($(this).parents('form'));
    });
    $('.input-file').change(function () {
        check($(this).parents('form'));
    });
    var nick_time = false;
    $('.input-nick').keyup(function () {
        if(nick_time) clearTimeout(nick_time);
        $(this).parents('form').find('.btn-info-buy').text('Загрузка..').prop('disabled',true);
        nick_time = setTimeout(()=>{
            check($(this).parents('form'));
        },500);
    });
});
function check(form) {
    if(form.find('.input-nick').val().length == 0) return form.find('.btn-info-buy').text('Введите ник').prop('disabled',true);
    if(form.find('select option:selected').is(':disabled')) return form.find('.btn-info-buy').text('Выберите донат').prop('disabled',true);
    $(form).data('ready',false);
    form.find('.btn-info-buy').text('Загрузка..').prop('disabled',true);
    var price = $(form).find('select option:selected').data('price');
    $.post('/handler.php',{
        type: 'extra',
        nick: form.find('.input-nick').val(),
        srv: form.find('.input-srv_id').val(),
		group: form.find('.select-group option:selected').val(),
		promocode: form.find('.input-promocode').val(),
        img: form.find('.input-file').val(),
		price: price,
    },function (data) {
        console.log(price,data);

        var val = form[0].querySelector("option:checked").getAttribute("value");
        if ((val == 32 || val == 33 || val == 34) && form.find('.input-file').val() == '') {
            form.find('.btn-info-buy').text('Купить за '+price+' рублей, выберете изображение').prop('disabled',true);
            return;
        }

        if (data.promo_discount != 0 && data.promo_discount != null) {
            if (data.data != 0 ){
                price -= (price - data.data) * data.promo_discount;
            } else {
                price -= price * data.promo_discount;
            }
        }
        if(data.error) form.find('.btn-info-buy').text('Ошибка: '+data.error).prop('disabled',false);
        // if(data.data >= price) form.find('.btn-info-buy').text('У вас уже есть данная привилегия').prop('disabled',true);
        if(data.data >= price) form.find('.btn-info-buy').text('Купить за '+price+' рублей').prop('disabled',false);

        else{
            $(form).find('.btn-info-buy').text(
                (data.data == 0)?
                'Купить за '+price+' рублей':
                'Доплатить '+(price-data.data)+' рублей'
            ).prop('disabled',false);
        }
        $(form).data('ready',true);
    },'json').fail(function() {
        form.find('.btn-info-buy').text('Ошибка.').prop('disabled',true);
        setTimeout(()=>check(form),5000);
    });
}