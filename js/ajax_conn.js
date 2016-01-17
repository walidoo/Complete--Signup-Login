/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

    $.ajax({
        url: "./lib/view_data.php",
        success: function(dataArray) {
            var dataList = $.parseJSON(dataArray);
            var maindata = "";
            for (var i = 0; i < dataList.dataArray.length; i++) {
                maindata +=
                        '<tr><td name="id">' + dataList.dataArray[i].id + '</td>' +
                        '<td>' + dataList.dataArray[i].first_name + '</td>' +
                        '<td>' + dataList.dataArray[i].last_name + '</td>' +
                        '<td>' + dataList.dataArray[i].age + '</td>' +
                        '<td>' + dataList.dataArray[i].department + '</td>' +
                        '<td><a href="./lib/edit_form.php?pid=' + dataList.dataArray[i].id + '">Edit</a></td>' +
                        '<td><a href="./lib/remove_data.php?pid=' + dataList.dataArray[i].id + '">Remove</a></td></tr>';

            }
            $(".data").html(maindata);
        }
    });


    $("search_btn").click(function() {

        $.ajax({
            url: "./lib/view_data.php",
            data:{
                searchkey:$("#searchKey").val()
            },
                    
            success: function(dataArray) {
                var dataList = $.parseJSON(dataArray);
                var maindata = "";
                for (var i = 0; i < dataList.dataArray.length; i++) {
                    maindata +=
                            '<tr><td name="id">' + dataList.dataArray[i].id + '</td>' +
                            '<td>' + dataList.dataArray[i].first_name + '</td>' +
                            '<td>' + dataList.dataArray[i].last_name + '</td>' +
                            '<td>' + dataList.dataArray[i].age + '</td>' +
                            '<td>' + dataList.dataArray[i].department + '</td>' +
                            '<td><a href="./lib/edit_form.php?pid=' + dataList.dataArray[i].id + '">Edit</a></td>' +
                            '<td><a href="./lib/remove_data.php?pid=' + dataList.dataArray[i].id + '">Remove</a></td></tr>';

                }
                $(".data").html(maindata);
            }
        });



    });
//   $(".remove").click(function(){
//       
//       
//   }); 

});

