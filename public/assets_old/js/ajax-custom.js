var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
    matches = [];
    substrRegex = new RegExp(q, 'i');
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });
    cb(matches);
  };
};


var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: 'https://ecommerce.unitymall.in/ajax-search/%QUERY',
          wildcard: '%QUERY'
        },
        
    });
    states.initialize();


$('.the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  display: 'name',
  source: states,
  templates: {
    empty: [
      '<div class="empty-message">',
        'No Record Found !',
      '</div>'
    ].join('\n'),
    suggestion: function (data) {
        return '<a href="https://ecommerce.unitymall.in/product-details/'+data.p_id+'" class="man-section"><div class="image-section"><img src='+data.image+'></div><div class="description-section"><h4>'+data.name+'</h4><span>₹'+data.price+'</span></div></a>';
    }
  },
});



