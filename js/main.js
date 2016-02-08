$(function(){


    $(document.body).on('click', '.addProduct', function(){
        var product = $('input.product').val();

        $.ajax({
                url: "add.php",
                type: "POST",
                data: ({product: product}),
                success: function(data){
                    if(data.success) {
                        $('.error').text('');
                        $('.product').val('');
                        var div = document.createElement('div');
                        var element = document.body.appendChild(div);
                        $(element).html("<div class='wrapProd" + data.id + "'>"
                            + "<div class='products' id='product" + data.id + "'>"+ data.product + "</div>"
                            + "<div class='edit'><img editFieldId='"+data.id+"'  class='imgEdit' src='images/stock-edit.png' /></div>"
                            + "<div class='delete'><img class='imgDelete'  src='images/delete.png' deleteId='" + data.id + "'/></div>"
                            + "<div class='clear'></div></div>");
                    }else{
                        $('.product').val('');
                        $('.error').text('Ошибка, такие данные существуют');
                    }
                    if(data.error){
                        $('.product').val('');
                        $('.error').text('Ошибка');
                    }
            }
        });
    });


    $(document.body).on('click', '.imgEdit', function(){
        $('.editBlock').remove();
        var editFieldId = $(this).attr('editFieldId');
        var div = document.createElement('div');
        var element = document.body.appendChild(div);
        $(element).addClass('editBlock');
        $(element).html("<input type='text' name='editProduct' editId='" + editFieldId + "' class='editProduct' value=''  /><button class='save' name='save'>Изменить</button>");
    });

    $(document.body).on('click', '.save', function(){
        var editInfo = $('input.editProduct').val();
        var editId = $('input.editProduct').attr('editId');
        var product = $('#product'+editId).html();
        $.ajax({
            url: "edit.php",
            type: "POST",
            data:({editInfo: editInfo, editId: editId, product: product}),
            success: function(data){
                if(data.success){
                    $('.error').remove();
                    $('.editBlock').remove();
                    $('#product'+editId).text(data.product);
                }else if(data.message){
                    $('.error').text(data.message);
                }
            }
        });
    });




    $(document.body).on('click', '.imgDelete', function(){
        var deleteId = $(this).attr('deleteId');
        var block_delete = $(this).parent().parent();

        $.ajax({
            url: "delete.php",
            type: "POST",
            data:({deleteId: deleteId}),
            success: function(data){
                if(data.delete){
                    $(block_delete).remove();
                }
            }
        });
    });



});