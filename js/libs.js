$(document).ready(function() {


/* ==================== Ajax ================= */

/*add time kart*/
function show_preloader() {
    $('.preloader').fadeIn();
}
function hide_preloader() {
    $('.preloader').fadeOut();
}
$(document).keydown(function(e) {
  if (e.keyCode == 75 && e.ctrlKey) {
    $('.rest').show();
  }
  if (e.keyCode == 27) {
    $('.rest').hide();
  }
});



function update_karts_table() {

  $.ajax({
    url: "get_karts_stats.php",                     //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
    success: function(data)          //on recieve of reply
      {
        $("#kt_ronfig1_dry").find('tbody').html('');
        $("#kt_ronfig1_dry").find('tbody').append(data);
        $('.timer_kart').startTimer({
            onComplete: function(){
              console.log('Complete');

          }
        });

      },
    error: function(data) {
      
    }
  });
}
console.log($("#kt_ronfig1_dry").length);
if ($("#kt_ronfig1_dry").length) {
  setInterval(function(){
  update_karts_table();
  console.log('update');
}, 4000);
}


$(".someclass").click(function(){
  update_karts_table();
});
$(".reset_lk").click(function(){
  console.log('Старт');
  if (confirm('Точно?')) {
    $.ajax({
      url: "get_karts_stats.php",  
      data: "reset_lk=true",               //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
      success: function(data)          //on recieve of reply
        {
          $("#kt_ronfig1_dry").find('tbody').html('');
          $("#kt_ronfig1_dry").find('tbody').append(data);
          $('.timer_kart').startTimer({
              onComplete: function(){
                console.log('reset lk');
            }
          });

        },
      error: function(data) {
        
      }
    });
  }
});

$('body').on('change', '#kt_ronfig1_dry select', function() {
  var name_select = $(this).attr('name');
  var best_lap_kart_id = $(this).parents('tr').attr('id');
  var select_val = $(this).val();
  console.log(name_select);
  if (name_select == 'stats_team_number') {
    console.log(select_val);
    var data = 'best_lap_team_id='+select_val;
  }
  if (name_select == 'stats_pilot_number') {
    var data = 'best_lap_pilot_id='+select_val;
  }
  
  console.log(data + "&best_lap_kart_id="+best_lap_kart_id);
  if (confirm('Точно?')) {
    $.ajax({
      url: "get_karts_stats.php",
      data: data + "&best_lap_kart_id="+best_lap_kart_id,                      //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
      success: function(data)          //on recieve of reply
        {
          console.log('super')
         // update_karts_table();
        },
      error: function(data) {
        
      }
    });
  }
});


$('body').on('change', '#pits_info_table select', function() {
  var name_select = $(this).attr('name');
  var team_id = $(this).parents('tr').attr('id');
  var select_val = $(this).val();

  console.log(name_select);
  console.log(team_id);
  console.log(select_val);

  if (name_select == 'pit_kart_number') {
    var pit_kart_number = select_val;
  }
  if (name_select == 'pit_pilot_number') {
    var pit_pilot_number = select_val;
    var pit_kart_number = $(this).parents('tr').find("#form_kart_numbers").val();
  }
  console.log(pit_kart_number + "|||" + pit_pilot_number);
  if (confirm('Точно?')) {
    $.ajax({
      url: "get_pits.php",
      data:"pit_kart_number="+ pit_kart_number + "&pit_pilot_number=" + pit_pilot_number + "&team_id=" + team_id,                      //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
      success: function(data)          //on recieve of reply
        {
          console.log(data);
        },
      error: function(data) {
        /* alert(data); */
      }
    });
  }
});


$('body').on('click', '#pits_info_table .button', function() {
  var team_id = $(this).parents('tr').attr('id');
  var kart_id = $(this).parents('tr').find('#form_kart_numbers').val();
  var pilot_id = $(this).parents('tr').find('#form_pilot_numbers').val();
  var number_pit = $(this).parents('tr').find('.number_pit').text();
  var lap_pit = $(this).parents('#'+kart_id).find('.timing_laps').text();
  console.log( kart_id);
  if (confirm('Точно?')) {
    $.ajax({
      url: "get_pits.php",
      data:"update_pits=true&team_id=" + team_id + "&kart_id=" + kart_id+"&pilot_id="+pilot_id+"&number_pit="+number_pit,                      //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
      success: function(data)          //on recieve of reply
        {
          console.log('yes');
          $("#pits_info_table").find('tbody').html('');
          $("#pits_info_table").find('tbody').append(data);
          $('.timer_pits').startTimer({
              onComplete: function(){
                console.log('Complete');
            }
          });
        },
      error: function(data) {
        console.log('no'); 
      }
    });
  }
});


if ($(window).width() <= '960' || $('#box_hist_1').length) {
// tabs
$('ul.tabs_menu').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a');

    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.addClass('active');

    $content = $($active[0].hash);

    // Hide the remaining content
    $links.not($active).each(function () {
       $(this.hash).hide();
    });

    // Bind the click event handler
    $(this).on('click', 'a', function(e){
        // Make the old tab inactive.
        $active.removeClass('active');
        $content.hide();

        // Update the variables with the new link and content
        $active = $(this);
        $content = $(this.hash);

        // Make the tab active.
        $active.addClass('active');
        $content.show();

        // Prevent the anchor's default click action
        e.preventDefault();
    });
});
}


/* ==================== Other ================= */

// pop-up
  $(".showwind").click(function(){
      var idlink = $(this).data("windowid");
      $("#windid_" + idlink).fadeIn().addClass("windactiv");
      $(".mask").fadeIn();
  });
   $(".mask, .bw_close").click(function(){
      $(".windactiv").fadeOut();
      $(".mask").fadeOut();
  });





$('.start').click(function(){
    console.log('Start race');
  $('.timer, .timer_cart, .timer_pits, .timer_pilot').startTimer({
      onComplete: function(){
        console.log('Complete');
    }
  });

  $.ajax({
    url: "start_race.php",
    data:"func=karts_timing&wether=dry&konfig=1",                      //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
    success: function(data)          //on recieve of reply
      {

      },
    error: function(data) {
      alert(data);
    }
  });

  $.ajax({
    url: "get_pits.php",                      //you can insert url argumnets here to pass to api.php                        //for example "id=5&parent=6"               //data format      
    success: function(data)          //on recieve of reply
      {

        $("#pits_info_table").find('tbody').html('');
        $("#pits_info_table").find('tbody').append(data);
        $('.timer_pits').startTimer({
            onComplete: function(){
              console.log('Complete');
          }
        });
      },
    error: function(data) {
      /* alert(data); */
    }
  });


});
  $('.pause').click(function(){
    var timer_id = $(this).data('timerid');
    timer_id.trigger('pause');
  });
   $('.return').click(function(){
      var timer_id = $(this).data('timerid');
       timer_id.trigger('pause');
 });

   // timers

  $('.timer, .timer_kart, .timer_pits').startTimer({
      onComplete: function(){
        console.log('Complete');
    }
  });


});



