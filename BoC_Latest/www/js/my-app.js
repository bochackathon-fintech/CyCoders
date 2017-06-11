// Initialize app
var myApp = new Framework7({
   modalTitle: 'BoC',
});


// If we need to use custom DOM library, let's save it to $$ variable:
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we want to use dynamic navbar, we need to enable it for this view:
    dynamicNavbar: true
});
var update_variable = 0;
// Handle Cordova Device Ready Event
$$(document).on('deviceready', function() {
    console.log("Device is ready!");
    getUserValues();
  var refreshInterval =  setInterval( getUpdates(refreshInterval), 3000 );

});


// Now we need to run the code that will be executed only for About page.

// Option 1. Using page callback for page (for "about" page in this case) (recommended way):
myApp.onPageInit('about', function (page) {
    // Do something here for "about" page

})

// Option 2. Using one 'pageInit' event handler for all pages:
$$(document).on('pageInit', function (e) {
    // Get page data from event data
    var page = e.detail.page;

    if (page.name === 'about') {
        // Following code will be executed for page with data-page attribute equal to "about"
        // myApp.alert('Here comes About page');
    }
})

// Option 2. Using live 'pageInit' event handlers for each page
$$(document).on('pageInit', '.page[data-page="about"]', function (e) {
    // Following code will be executed for page with data-page attribute equal to "about"
    // myApp.alert('Here comes About page');
})

function getUserValues(){
  $.get("http://127.0.0.1:8000/user-value", function(data, status){
    console.log(data);
      // $('#user-information').append('<h2>'+data.user.email+'</h2>');
      $('#labelBalance').append(data.info.available_amount);
      $('#piggylabel').append(data.info.pinky);
 });
}
function getUpdates(refreshInterval) {
  $.get("http://127.0.0.1:8000/updates", function(data, status) {
    if (data != "") {
      update_variable = 1;
      clearInterval(refreshInterval);
      myApp.prompt('You made a charge of ' + data[0].amount + 'Do you want to transfer money to your Piggy?', function(value) {
        if (value === "") {
          myApp.alert('You didnt save any money for this transaction');
        } else {
          console.log(value);
          PinkyUpdate(value);
        }
      })

    };
  });

}
function PinkyUpdate(value){
  $.ajax({
    type: 'POST',
    url: 'http://127.0.0.1:8000/update-response',
    crossDomain: true,
    data: {
      'amount': value
    },
    success: function(data) {
      console.log(data);
      myApp.alert('Your settings have been successfully saved');
    },
    error: function() {
      myApp.alert();
    }
  }) //end post ajax
  }
function SetUserSettings(){
  var amount = $('#amount').val();
  if (amount >100){
    myApp.alert('Please add a correct value');
  }else{
    $.ajax({
      type: 'POST',
      url: 'http://127.0.0.1:8000/user-value-post',
       crossDomain: true,
      data: {
        'amount': $('#amount').val()
      },
      success: function(data) {
        myApp.alert('Your settings have been successfully saved');
    },
    error: function(){
      myApp.alert('Please add a correct value');
    }

  })
  }
}
