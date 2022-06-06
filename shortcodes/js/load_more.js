// jQuery( document ).ready( function(){
//     var page = 2;
//     jQuery( function($) {
//       jQuery( 'body' ).on( 'click', '.load-more-btn', function() {
//         jQuery( '.load-more-btn' ).hide();  //After Clicking hide the Load More Button
//         var data = {
//           'action': 'load_posts_by_ajax',
//           'page': page,
//           'security': products.security,
//         };
//         jQuery.post( products.ajaxurl, data, function( response ) {
//           if( $.trim(response) != '') {
//             jQuery( '.product-wrap' ).append( response );
//             page++;
//           } else {
//             jQuery( '.load-more-btn' ).hide();
//           }
//         });
//       });
//     });
//   });

jQuery(document).ready(function($) {
  let loadContainer = $('.load-more-container');
  let postType = loadContainer.data('post');
  let cat = loadContainer.data('category');
  let max_pages = loadContainer.data('max_pages');
  let page_no = loadContainer.data('page_no');
  console.log(postType);
  console.log(cat);
  console.log(max_pages);
  console.log('page no:'+ page_no );
  console.log(typeof(page_no));
  let currentPage = page_no;
  if( max_pages == 1){
    $( '#load-more' ).hide();
  }

  //On Document load if maximum 

$('#load-more').on('click', function() {
  currentPage++; // Do currentPage + 1, because we want to load the next page
  console.log('On Click Current Page: ' + currentPage);

  //Change data attribute value
  loadContainer.attr('data-page_no', currentPage);
  $.ajax({
    type: 'POST',
    url: products.ajaxurl,
    dataType: 'json',
    data: {
      action: 'load_more',
      paged: currentPage,
      postType: postType,
      category: cat == '' ? '' : cat,
    },
    success: function (res) {
      // console.log('from sucess');
      // console.log(res.paged);
      // console.log(res.max);

      // $( '#load-more' ).hide();
      $( '.load-more-container' ).append(res.html);

      if( res.paged >= res.max ) {
        $( '#load-more' ).hide();
      }
      // if( res.paged < res.max){
      //   $( '#load-more' ).show();
      // }
    }
  });
});
});
