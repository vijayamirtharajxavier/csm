var currentURL = window.location.href.split('/')[6];//window.location.href;
console.log(currentURL);

var base_url = $("#base_url").val();
if( currentURL=="form_member" || currentURL=="form_application" ){
var urlstr = base_url + 'fetchMember';
var url = urlstr.replace("undefined","");
}
console.log('Test ' + url);



$(document).ready(function(){
console.log('test1');







$(function () {
 // console.log('testssss');
    var searchlist = new Bloodhound({
        datumTokenizer: function (searchlist) {
          console.log(searchlist);
            return Bloodhound.tokenizers.whitespace(searchlist.member_name);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: url,
            wildcard: '%QUERY',
            filter: function (response) {
            //  console.log(response);
             return response.suggestions; 
           }
        }
    });

    // Initialize the searchlist
    searchlist.initialize();

    $('#searchBox').typeahead({
        hint: true,
        highlight: true,
        minLength: 3
    },
        {
            name: 'searchlist',
            displayKey: function (suggestions) { return suggestions.keyword },
            source: searchlist.ttAdapter(),
            limit: 10
        });
});


     $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: url,
          data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                  //    console.log(data);
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });

$('.ajax-typeahead').typeahead({
    source: function(query, process) {
    //  console.log($(this)[0].$element[0].dataset.link);
        return $.ajax({
            url: url,
            type: 'get',
            data: {query: query},
            dataType: 'json',
            success: function(json) {
           //   console.log(json);
                return typeof json.options == 'undefined' ? false : process(json.options);
            }
        });
    }
});

});

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};




//-------------------------//

    var persons = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('member_name'), //The server returns the JSON of Person Name, the corresponding field named personName 
      queryTokenizer: Bloodhound.tokenizers.whitespace,
       ttl_ms: 0,
        prefetch: url,
      remote:{ 
        url: url, //'/personService?personName=%QUERY',  //'%QUERY' Will be the user input value instead of
        filter: function(resp){ //The server may not be directly to the JSON array method returns the search results. If not specified, the search results in a path in JSON. 
        //    console.log(resp);
            return resp.personList;
          }         
      }

    });
     
    
    persons.initialize();
     
    $('#personNameInput').typeahead({ //Put the input frame into auto complete style
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'thePersons', //In fact, not what, just used to construct DOM elements generated CSS class name
      displayKey: 'member_name', //The choice of good results, field displays the input box
      source: persons.ttAdapter(), //Please copy
    empty: [
      '<div class="empty-message">',
        'Member Name Not Found!!',
      '</div>'
    ].join('\n'),

      templates: { //This function determines the drop-down list for each row how to render.  
       //   suggestion: Handlebars.compile('<p>ID:{{member_id}} - name:{{member_name}}</p>')  //This is a template, the inside of the {{xxx}} XXX server is returned by the corresponding JSON data in the field. Below will illustrate the role of Handlebars. 
        }
    }).on('typeahead:selected',function(evt,datum){
      $('#surety_id').val(datum.member_id); //Select a user from the drop-down in an item, refresh the read-only personId value
    });     






  


var states = ["Andorra","United Arab Emirates","Afghanistan","Antigua and Barbuda","Anguilla","Albania","Armenia","Angola","Antarctica","Argentina","American Samoa","Austria","Australia","Aruba","Åland","Azerbaijan","Bosnia and Herzegovina","Barbados","Bangladesh","Belgium","Burkina Faso","Bulgaria","Bahrain","Burundi","Benin","Saint Barthélemy","Bermuda","Brunei","Bolivia","Bonaire","Brazil","Bahamas","Bhutan","Bouvet Island","Botswana","Belarus","Belize","Canada","Cocos [Keeling] Islands","Congo","Central African Republic","Republic of the Congo","Switzerland","Ivory Coast","Cook Islands","Chile","Cameroon","China","Colombia","Costa Rica","Cuba","Cape Verde","Curacao","Christmas Island","Cyprus","Czechia","Germany","Djibouti","Denmark","Dominica","Dominican Republic","Algeria","Ecuador","Estonia","Egypt","Western Sahara","Eritrea","Spain","Ethiopia","Finland","Fiji","Falkland Islands","Micronesia","Faroe Islands","France","Gabon","United Kingdom","Grenada","Georgia","French Guiana","Guernsey","Ghana","Gibraltar","Greenland","Gambia","Guinea","Guadeloupe","Equatorial Guinea","Greece","South Georgia and the South Sandwich Islands","Guatemala","Guam","Guinea-Bissau","Guyana","Hong Kong","Heard Island and McDonald Islands","Honduras","Croatia","Haiti","Hungary","Indonesia","Ireland","Israel","Isle of Man","India","British Indian Ocean Territory","Iraq","Iran","Iceland","Italy","Jersey","Jamaica","Jordan","Japan","Kenya","Kyrgyzstan","Cambodia","Kiribati","Comoros","Saint Kitts and Nevis","North Korea","South Korea","Kuwait","Cayman Islands","Kazakhstan","Laos","Lebanon","Saint Lucia","Liechtenstein","Sri Lanka","Liberia","Lesotho","Lithuania","Luxembourg","Latvia","Libya","Morocco","Monaco","Moldova","Montenegro","Saint Martin","Madagascar","Marshall Islands","Macedonia","Mali","Myanmar [Burma]","Mongolia","Macao","Northern Mariana Islands","Martinique","Mauritania","Montserrat","Malta","Mauritius","Maldives","Malawi","Mexico","Malaysia","Mozambique","Namibia","New Caledonia","Niger","Norfolk Island","Nigeria","Nicaragua","Netherlands","Norway","Nepal","Nauru","Niue","New Zealand","Oman","Panama","Peru","French Polynesia","Papua New Guinea","Philippines","Pakistan","Poland","Saint Pierre and Miquelon","Pitcairn Islands","Puerto Rico","Palestine","Portugal","Palau","Paraguay","Qatar","Réunion","Romania","Serbia","Russia","Rwanda","Saudi Arabia","Solomon Islands","Seychelles","Sudan","Sweden","Singapore","Saint Helena","Slovenia","Svalbard and Jan Mayen","Slovakia","Sierra Leone","San Marino","Senegal","Somalia","Suriname","South Sudan","São Tomé and Príncipe","El Salvador","Sint Maarten","Syria","Swaziland","Turks and Caicos Islands","Chad","French Southern Territories","Togo","Thailand","Tajikistan","Tokelau","East Timor","Turkmenistan","Tunisia","Tonga","Turkey","Trinidad and Tobago","Tuvalu","Taiwan","Tanzania","Ukraine","Uganda","U.S. Minor Outlying Islands","United States","Uruguay","Uzbekistan","Vatican City","Saint Vincent and the Grenadines","Venezuela","British Virgin Islands","U.S. Virgin Islands","Vietnam","Vanuatu","Wallis and Futuna","Samoa","Kosovo","Yemen","Mayotte","South Africa","Zambia","Zimbabwe"];;







$('#s-_name .typeahead').typeahead({

  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});


$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});

// ---------- Bloodhound ----------

// constructs the suggestion engine
var states = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  local: states
});

$('#bloodhound .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: states
});


// -------- Prefatch --------

var xcountries = new Bloodhound({
  //datumTokenizer: Bloodhound.tokenizers.whitespace,
datumTokenizer: Bloodhound.tokenizers.obj.whitespace('member_name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // url points to a json file that contains an array of country names, see
  // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
  identify: function(obj) { return obj.name; },
  prefetch: url //'../plugins/bower_components/typeahead.js-master/countries.json'
});

// passing in `null` for the `options` arguments will result in the default
// options being used
$('#prefetch .typeahead').typeahead(null, {
  name: 'name',
  source: xcountries
});

// -------- Custom --------

var nflTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  identify: function(obj) { return obj.name; },
  prefetch: url // '../plugins/bower_components/typeahead.js-master/nfl.json'
});

function nflTeamsWithDefaults(q, sync) {
  if (q === '') {
    sync(nflTeams.get('Detroit Lions', 'Green Bay Packers', 'Chicago Bears'));
  }

  else {
    nflTeams.search(q, sync);
  }
}

$('#default-suggestions .typeahead').typeahead({
  minLength: 0,
  highlight: true
},
{
  name: 'nfl-teams',
  display: 'name',
  source: nflTeamsWithDefaults
});




// -------- Multiple --------
//$('#custom-templates .typeahead').typeahead('destroy');
var nbaTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('member_name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
 
  //cache: false,
 prefetch: url,

  remote: {
        url: url,
        filter: function (data) {
            if (data) {
              
                return $.map(data, function (object) {
           //     console.log(object);

                // return $('#surety_id').val(object.id);
          return { id: object.member_id, value: object.member_name};
         //  return object;     
                });
            } else {
                return {};
            }
        }
    },


});






$('#custom-templates .typeahead').typeahead(null,{
  hint: true,
  highlight: true,
  minLength: 1,
  //name: 'best-pictures',
  display: 'value',
  source: nbaTeams,
  templates: {
header: [
                    '<div class="input-group input-results-dropdown">'
                ],
    empty: [
      '<div class="empty-message">',
        'Member Name Not Found!!',
      '</div>'
    ].join('\n'),
//suggestion: function (data) {

  //                          return '<a class="list-group-item">'  + data.member_name + ' ' +data.member_id + '</a>'

  //  suggestion: Handlebars.compile('<div><strong>{{value}}</strong> – {{id}}</div>')
  //}
}

}).on('typeahead:select', function(ev, suggestion) {
  console.log(suggestion);
     $('#surety_id').val(suggestion.member_id);
    // $('#hidden-input').val(d[resultList.indexOf(suggestion)].id);
});








var nhlTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('dob'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: '../plugins/bower_components/typeahead.js-master/nhl.json'



});






$('#multiple-datasets .typeahead').typeahead({
  highlight: true
},
{
  name: 'nba-teams',
  display: 'name',
  source: nbaTeams,
 

  templates: {

   // header: '<h3 class="league-name">Surety Member</h3>'
   // suggestion: Handlebars.compile("<div>{{name}}</div>")
 
//        suggestion: Handlebars.compile("<div>{{#if name}}Name: <strong>{{name}}</strong>{{/if}} {{#if email}} Email: <strong>{{email}}</strong> {{/if}} {{#if github_username}} Github username: <strong>{{github_username}}</strong> {{/if}} </div>")

 
  }
  
},
{
  name: 'nhl-teams',
  display: 'team',
  source: nhlTeams,
  templates: {
   // header: '<h3 class="league-name">NHL Teams</h3>'
  }

});
     
// -------- Scrollable --------



$('#scrollable-dropdown-menu .typeahead').typeahead(null, {
  name: 'states',
  limit: 10,
  source: states
});





$('#autocomplete').typeahead({
    source: function(query, process) {
        objects = [];
        map = {};
        var data = [{"id":1,"label":"machin"},{"id":2,"label":"truc"}] // Or get your JSON dynamically and load it into this variable
        $.each(data, function(i, object) {
            map[object.label] = object;
            objects.push(object.label);
        });
        process(objects);
    },
    updater: function(item) {
        $('surety_id').val(map[item].id);
        return item;
    }
});                 





 var $country = $('#txtCountry');

    var countries = new Bloodhound({
        datumTokenizer: function (d) { return Bloodhound.tokenizers; },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: url,
            filter: function(list) {
                return $.map(list, function(item) {
               //  console.log(item);
                    return {
        
                        name: item.member_name,
                        slg: item.surety_flag,
                        code: item.member_id
                    };
                });
            },
            cache: false
        }
    });


$('#--txtCountry .typeahead').typeahead(null,{
  hint: true,
  highlight: true,
  minLength: 1,
  //name: 'best-pictures',
  display: 'value',
  source: nbaTeams,
  templates: {
header: [
                    '<div class="input-group input-results-dropdown">'
                ],
    empty: [
      '<div class="empty-message">',
        'Member Name Not Found!!',
      '</div>'
    ].join('\n'),
//suggestion: function (data) {

  //                          return '<a class="list-group-item">'  + data.member_name + ' ' +data.member_id + '</a>'

 //   suggestion: Handlebars.compile('<div><strong>{{value}}</strong> – {{id}}</div>')
  //}
}

}).on('typeahead:select', function(ev, suggestion) {
  console.log(suggestion);
     $('#surety_id').val(suggestion.member_id);
    // $('#hidden-input').val(d[resultList.indexOf(suggestion)].id);
});



//---//

if( currentURL=="form_member" || currentURL=="form_application"){
var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");
}


var bPictures = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('member_name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: url,//'../data/films/post_1960.json',
  remote: {
    url:url + '/%QUERY', // '../data/films/queries/%QUERY.json',
    wildcard: '%QUERY'
  }
});

$('#ajxremote .typeahead').typeahead(null, {
   hint: true,
  highlight: true,
 
  name: 'best-pictures',
  display: 'member_name',
  source: bPictures
}).on('typeahead:select', function(ev, suggestion) {
  console.log(suggestion);
  if(suggestion.surety_flag=="Y" && currentURL=="form_member"){
  console.log('Yes');
  $('#ajxremote').removeClass('form-control-success').addClass('form-control-warning');
    $('#ajxremote').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
    $('#surety_name').removeClass('form-control-success').addClass('form-control-warning');
    $('#surety_id').val(suggestion.member_id);
    
    $('#memberNumber').val(suggestion.member_id);
    alert('Suerty Already Given to someone...');
  }
  else {
    console.log('No');
     $('#ajxremote').removeClass('has-warning').addClass('has-success');
     $('#ajxremote').removeClass('cssText').addClass('has-success has-feedback m-b-40');
     $('#surety_name').removeClass('form-control-warning').addClass(' form-control-success');
     $('#surety_id').val(suggestion.member_id);
     $('#memberNumber').val(suggestion.member_id);
     $('#fahuName').val(suggestion.fahu_name);
     $('#dob').val(suggestion.dob);

if(currentURL=="create_receipt" || currentURL=="create_payment")
{
  $('memberNumber').val(suggestion.member_id);
}

     if(currentURL=="form_application"){
     $('#memberNumber').val(suggestion.member_id);
     $('#doj').val(suggestion.doj);
     $('#designation').val(suggestion.designation_id);

age_function();


   }



    // $('#hidden-input').val(d[resultList.indexOf(suggestion)].id);
}
});


function age_function() {
  var today = new Date();
var curr_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
//alert(curr_date);
var doj_dt  = $('#doj').val();



const date1 = new Date(doj_dt);
const date2 = new Date(curr_date);
const diffTime = Math.abs(date2.getTime() - date1.getTime());
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
//console.log(diffDays);
//alert(diffDays);
var nys= diffDays/365;
$('#nys').val(parseInt(nys)+' Years of service');

  
var dob_dt  = $('#dob').val();

const date3 = new Date(dob_dt);
const date4 = new Date(curr_date);
const diffTime1 = Math.abs(date4.getTime() - date3.getTime());
const diffDays1 = Math.ceil(diffTime1 / (1000 * 60 * 60 * 24)); 
//console.log(diffDays);
//alert(diffDays);
var age= diffDays1/365;
var rtrage = 58;
var rys = rtrage-age;
$('#age').val(parseInt(age)+' Years of age');
$('#rys').val(parseInt(Math.round(rys))+' Years of service');


}



if( currentURL=="form_member" || currentURL=="form_application"){
var urlstr = base_url + 'fetchMemberlistbyId';
var url = urlstr.replace("undefined","");
}

var bMembers = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('member_id'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: url,//'../data/films/post_1960.json',
  remote: {
    url:url + '/%QUERY', // '../data/films/queries/%QUERY.json',
    wildcard: '%QUERY'
  }
});

$('#ajxmemberNumber .typeahead').typeahead(null, {
   hint: true,
  highlight: true,
 
  name: 'best-pictures',
  display: 'member_id',
  source: bMembers
}).on('typeahead:select', function(ev, suggestion) {
  console.log(suggestion);
  if(suggestion.surety_flag=="Y" && currentURL=="form_member"){
  console.log('Yes');
  $('#ajxremote').removeClass('form-control-success').addClass('form-control-warning');
    $('#ajxremote').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
    $('#surety_name').removeClass('form-control-success').addClass('form-control-warning');
    $('#surety_id').val(suggestion.member_id);
    
    $('#memberNumber').val(suggestion.member_id);
    alert('Suerty Already Given to someone...');
  }
  else {
    console.log('No');
     $('#ajxremote').removeClass('has-warning').addClass('has-success');
     $('#ajxremote').removeClass('cssText').addClass('has-success has-feedback m-b-40');
     $('#surety_name').removeClass('form-control-warning').addClass(' form-control-success');
     $('#surety_id').val(suggestion.member_id);
     $('#memberNumber').val(suggestion.member_id);
     $('#fahuName').val(suggestion.fahu_name);
     $('#dob').val(suggestion.dob);

if(currentURL=="create_receipt" || currentURL=="create_payment")
{
  $('memberNumber').val(suggestion.member_id);
}

     if(currentURL=="form_application"){
     $('#memberName').val(suggestion.member_name);
     $('#designation').val(suggestion.designation_id);
     $('#doj').val(suggestion.doj);
     age_function();
   }



    // $('#hidden-input').val(d[resultList.indexOf(suggestion)].id);
}
});


if( currentURL=="create_receipt" || currentURL=="create_payment" || currentURL=="all_receipt"){
var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");
}

var aLedger = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('account_name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
 // prefetch: url,//'../data/films/post_1960.json',
  remote: {
    url:url + '/%QUERY', // '../data/films/queries/%QUERY.json',
    wildcard: '%QUERY'
  }
});

$('#ldgremote .typeahead').typeahead(null, {
   hint: true,
  highlight: true,
 
  name: 'best-ledger',
  display: 'account_name',
  source: aLedger
}).on('typeahead:select', function(ev, suggestion) {
  //console.log(suggestion);
    $('#accountNumber').val(suggestion.id);

});



if( currentURL=="create_journal"){
var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");
}

var aLedger = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('account_name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
 // prefetch: url,//'../data/films/post_1960.json',
  remote: {
    url:url + '/%QUERY', // '../data/films/queries/%QUERY.json',
    wildcard: '%QUERY'
  }
});


$('#debitldgr .typeahead').typeahead(null, {
   hint: true,
  highlight: true,
 
  name: 'best-ledger',
  display: 'account_name',
  source: aLedger
}).on('typeahead:select', function(ev, suggestion) {
  //console.log(suggestion);
    $('#debitaccountNumber').val(suggestion.id);

});


$('#creditldgr .typeahead').typeahead(null, {
   hint: true,
  highlight: true,
 
  name: 'best-ledger',
  display: 'account_name',
  source: aLedger
}).on('typeahead:select', function(ev, suggestion) {
  console.log(suggestion);
    $('#creditaccountNumber').val(suggestion.id);
    $('#creditmemberNumber').val(suggestion.member_id);

});






if( currentURL=="create_officenote"){
var urlstr = base_url + 'fetchApplicationlist';
var url = urlstr.replace("undefined","");
}

var bAppln = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('app_number'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: url + '/?qry=%QUERY', // '../data/films/queries/%QUERY.json',
    wildcard: '%QUERY',//'../data/films/post_1960.json',
  remote: {
    url:url + '/?qry=%QUERY', // '../data/films/queries/%QUERY.json',
    wildcard: '%QUERY'
  }
});

$('#ajxappNumber .typeahead').typeahead(null, {
   hint: true,
  highlight: true,
 
  name: 'best-application',
  display: 'app_number',
  source: bAppln
}).on('typeahead:select', function(ev, suggestion) {
  console.log(suggestion);
  if(currentURL=="create_officenote"){
  //console.log('Yes');
  //  $('#ajxremote').removeClass('form-control-success').addClass('form-control-warning');
   // $('#ajxremote').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
  
  //  $('#smember_name').removeClass('form-control-success').addClass('form-control-warning');
  //$("#createOfficenoteForm").trigger("reset");
  $("#amt_sanctioned").val("");
    $('#smember_id').val(suggestion.surety_id);
    $('#smember_name').val(suggestion.surety_name);

    $('#bmember_name').val(suggestion.member_name);
    $('#bmember_id').val(suggestion.member_id);
    var loanout = parseFloat(suggestion.loan_outstanding);
    $('#duetoamount0').val(loanout.toFixed(2));

    var roi=parseFloat(suggestion.rate_of_interest);
    var interest = ((loanout*roi/100)/12);
    console.log(roi);
   $('#duetoamount1').val(interest.toFixed(2));
   var msharecap = parseFloat(suggestion.mshare_capital);
   var ssharecap = parseFloat(suggestion.sshare_capital);
   $('#duetoamount2').val(msharecap.toFixed(2));
   $('#duetoamount3').val(ssharecap.toFixed(2));
   var sts = suggestion.app_status;
   $("#status_change").val(sts);


   duetoamtCalc();

   // alert('Suerty Already Given to someone...');
  }
  else {
  //  console.log('No');
     $('#ajxremote').removeClass('has-warning').addClass('has-success');
     $('#ajxremote').removeClass('cssText').addClass('has-success has-feedback m-b-40');
     $('#surety_name').removeClass('form-control-warning').addClass(' form-control-success');
     $('#surety_id').val(suggestion.surety_id);
     $('#memberNumber').val(suggestion.member_id);
     $('#fahuName').val(suggestion.fahu_name);
     $('#dob').val(suggestion.dob);

if(currentURL=="create_receipt" || currentURL=="create_payment")
{
  $('memberNumber').val(suggestion.member_id);
}

     if(currentURL=="form_application"){
     $('#memberName').val(suggestion.member_name);
     $('#designation').val(suggestion.designation_id);
     $('#doj').val(suggestion.doj);
     age_function();
   }



    // $('#hidden-input').val(d[resultList.indexOf(suggestion)].id);
}
});



function duetoamtCalc() {
   
    var duetoamt_sum = 0;
    var net_pay=0;
    $('.duetoamt').each(function() {
        duetoamt_sum+= Number($(this).val());
    });
    
    var sanc_amt = $("#amt_sanctioned").val();

    $("#tot_due").val(Number(duetoamt_sum));

    $("#amt_tobe_adju").val(Number(duetoamt_sum));

    var bal_amt = Number(sanc_amt-duetoamt_sum);


    $("#bal_amt").val(bal_amt);
    var Inwords = convertNumberToWords(bal_amt);
    $("#rupees_words").val(Inwords);


}


