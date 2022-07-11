jQuery(document).ready(function($) { 
  let queryArray = $('#myField').val();
  let jsonArrayObj = JSON.parse(queryArray);
  let shortcodeContainer = $('.show-post-container');
  let loadContainer = $('.show-post-content');
  let loadMoreBtn = document.getElementById('load-more');
  // let postType = loadContainer.data('post');
  let max_pages = jsonArrayObj.maxPageNumber;
  // let page_no = loadContainer.data('page_no');
  // let ppp = loadContainer.data('ppp');//ppp means posts per page
  // let dataOrder = loadContainer.data('order');
  let catList = []; //Contains list of categories that are checked
  
  let checkedBox;
  jsonArrayObj.categoryArray = catList;
  // console.log(jsonArrayObj.categoryArray);



  console.log(jsonArrayObj);
  // console.log(loadContainer.hasClass('masonry-layout'));
  let masonryActive = loadContainer.hasClass('masonry-layout');//Tells whether masnory layout active or not
  console.log(masonryActive);
  
  if(masonryActive == true)
  {
    item = $(' .content');
    function reinitializeMasonry() {
      let theNest = $(' .masonry-layout');
      theNest.imagesLoaded( function() {
        theNest.masonry({
          itemSelector: '.content',
          isAnimated: true,
          columnWidth: 80,
        })
      })
    }
    reinitializeMasonry();
  }




  let currentPage = jsonArrayObj.paged;
  if( max_pages == 1){
    $( '#load-more' ).hide();
  }

  //Masnory Update
  let masonryUpdate = function() {
    setTimeout(function() {
        $('.masonry-layout').masonry();
    }, 500);
}


// $('#load-more').on('click', function() {
//   currentPage++; // Do currentPage + 1, because we want to load the next page
//   console.log('On Click Current Page: ' + currentPage);

//   //Change data attribute value
//   loadContainer.attr('data-page_no', currentPage);
//   $.ajax({
//     type: 'POST',
//     url: products.ajaxurl,
//     dataType: 'json',
//     data: {
//       action: 'load_more',
//       paged: currentPage,
//       postType: postType,
//       category: catList == [] ? [] : catList,
//       posts_per_page: ppp,
//     },
//     success: function (res) {
//       console.log('from sucess');
//       console.log('Paged Number: '+res.paged);
//       console.log('Maximum Number of pages: '+res.max);

//       // $( '#load-more' ).hide();
//       $( '.show-post-content' ).append(res.html);

//       if( res.paged >= res.max ) {
//         $( '#load-more' ).hide();
//       }
//       // if( res.paged < res.max){
//       //   $( '#load-more' ).show();
//       // }
//     }
//   });
// });


//Masonry Grid Layout Functions
// function resizeGridItem(item){
//   grid = document.getElementsByClassName("show-post-content")[0];
//   rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
//   rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
//   rowSpan = Math.ceil((item.querySelector('.post-container').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
//   item.style.gridRowEnd = "span "+rowSpan;
// }

// function resizeAllGridItems(){
//   allItems = document.getElementsByClassName("content");
//   console.log("The length of allItems array is:"+allItems.length);
//   for(x=0;x<allItems.length;x++){
//   resizeGridItem(allItems[x]);
//   }
// }
//End of Masonry layout functions


// //Call to Masonry Grid
// $( window ).on("load", function() {
//   console.log("On document on load this line was executed");
//   resizeAllGridItems();
// });

// $( window ).on("resize", resizeAllGridItems());

// //In Progress
// $('.change-style').on('click', function() {
//   console.log('on click');
//   loadContainer.addClass("display-grid");

// });

//Check if data attribute of category filter is yes or no
if(jsonArrayObj.category_filter == 'yes') {
  //Start of Category filter
  //When category is checked 
  $('.category-input').on('change', function() {
    $(".content").hide(300, "linear");
    currentPage = 1;
  //   $('input[name="category-checkbox"]:checked').each(function() {
  //     if( (catList.includes(this.value) == false ))
  //     catList.push(this.value);
  //  });
  if($(this).prop("checked") == true){
    console.log("Checkbox is checked.");
    catList.push(this.value);
    jsonArrayObj.categoryArray = catList;
    console.log('Category Array------'+jsonArrayObj.categoryArray);
  }
  else if($(this).prop("checked") == false){
    console.log("Checkbox is unchecked.");
    if(catList.includes(this.value)){
      catList.splice(catList.indexOf(this.value), 1);
      jsonArrayObj.categoryArray = catList;
      console.log('Category Array------'+jsonArrayObj.categoryArray);
    }
  }

  $('.post-container').hide(300, "linear"); //Remove previous post container on every checkbox click
  $.ajax({
    type: 'POST',
    url: products.ajaxurl,
    dataType: 'json',
    data: {
      action: 'load_more',
      // paged: currentPage,
      // postType: postType,
      // category: catList == [] ? [] : catList,
      // posts_per_page: ppp,
      // order: dataOrder,
      object: jsonArrayObj,
    },
    success: function (res) {
      // console.log('from dropdown sucess');
      // console.log(res.paged);
      // console.log(res.max);
      loadContainer.empty();//Here because of when empty button will come in place of remove element
      // $( '#load-more' ).hide();
      $( '.show-post-content' ).append(res.html);
  
      if( res.paged >= res.max ) {
        $( '#load-more' ).hide();
      }
      if( res.paged < res.max){
        $( '#load-more' ).show();
      }
    },
  
  });
  
  });
  //End of Category Filter
}





//Layout Filter
$('.layout-input').on('change', function() {
  checkedBox = $(this);
  console.log('Checkbox Value'+checkedBox.val());
  if(checkedBox.is(":checked")) {
    let group = "input:checkbox[name='" + checkedBox.attr("name") + "']";
    $(group).prop("checked", false);
    checkedBox.prop("checked", true);
  }
  else {
    loadContainer.removeClass(' two-post-layout masonry-post-layout');
    // $('.content').removeAttr('style');
    // loadContainer.removeAttr('style');
  }
  if( $(this).val() == 'grid-post-layout') {
    if( $(this).prop("checked") == true) {
      if(masonryActive == true) {
        $('.show-post-content').removeClass(' masonry-layout');
        loadContainer.masonry('destroy');
        masonryActive = false;
      }

      $('.show-post-content').removeClass(' three-post-layout');
      $('.show-post-content').addClass(' two-post-layout');
      // $('.post-container').addClass(' two-col-grid');
      
    }
    else {
      $('.show-post-content').removeClass(' two-post-layout');
      loadContainer.addClass(' three-post-layout');
    }
  }
  else if( $(this).val() == 'masonry-post-layout' ) {
    if( $(this).prop("checked") == true ) {
      masonryActive = true;
      $(' .show-post-content').removeClass(' three-post-layout');
      $(' .show-post-content').removeClass(' two-post-layout');
      $('.show-post-content').addClass(' masonry-layout');
      item = $(' .content');
      function reinitializeMasonry() {
        let theNest = $(' .masonry-layout');
        theNest.imagesLoaded( function() {
          theNest.masonry({
            itemSelector: '.content',
            isAnimated: true,
            columnWidth: 80,
          })
        })
      }
      reinitializeMasonry();
      // myMasonry = theNest.imagesLoaded( function() {
      //   $(' .masonry-layout').masonry({
      //     itemSelector: '.content',
      //     isAnimated: true,
      //     columnWidth: 80
      //   })
      // });
      // Call to Masonry Grid
      // $( window ).on('load', myMasonry);
      // myMasonry;
    }
    else{
      masonryActive = false;
      $('.show-post-content').removeClass(' masonry-layout');
      $('.show-post-content').addClass(' three-post-layout');
      loadContainer.masonry('destroy');
    }
  }
  });


//End of Layout Filter

// let btnCoordinate = loadMoreBtn.getBoundingClientRect();
//Scroll function start
$(window).on("scroll", function() {
  if($('#load-more').length) {
    let btnCoordinate = loadMoreBtn.getBoundingClientRect();
    // console.log("Button End Coordinate: "+btnCoordinate.bottom );
    if( ( $( window ).scrollTop() ) >= (( btnCoordinate.bottom - $( window ).height() ) + $( window ).scrollTop()) + 100 ) {                                                    //btnCoordinate.bottom <= ( $(window).scrollTop() + $(window).height() )
      currentPage++;
      jsonArrayObj.paged = currentPage;
      //Change data attribute value
      // loadContainer.attr('data-page_no', currentPage);
      $.ajax({
        type: 'POST',
        url: products.ajaxurl,
        async: false,
        dataType: 'json',
        data: {
          action: 'load_more',
          // paged: currentPage,
          // postType: postType,
          // category: catList == [] ? [] : catList,
          // posts_per_page: ppp,
          // order: dataOrder,
          object: jsonArrayObj,
        },
        success: function (res) {
          // $( '#load-more' ).hide();
          // console.log('After hiding Load More Btn');
          if(masonryActive == false) {

            $( '.show-post-content' ).append(res.html);
            
          }
          // if(checkedBox.is(":checked") == true) {
          //   if(checkedBox.val() == 'masonry-post-layout') {
  
          //     $('.masonry-layout').masonry('reloadItems');
          //   }
          // }
  
  
          if( res.paged < res.max){
            $( '#load-more' ).show();
          }
          if(checkedBox == undefined) {
            // console.log('Checkbox is not checked')
          }

          if( res.paged >= res.max ) {
            $( '#load-more' ).hide();
          }
          console.log(loadContainer.hasClass('masnory-layout'));
          if( masonryActive == true ) {
            console.log('From load Container');
            $('.masonry-layout').masonry()
              .append(res.html)
              .masonry('reloadItems')
              .masonry('appended', res.html)
              .masonry()
          }

        },
      });
    } //End of scrollTop check if statement
  }//End of load more button check if it exist or not
  else {
    return;
  }
}); //Scroll funtion end

});


