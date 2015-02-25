var app = angular.module('priceReq', ['ngCookies']);

app.controller('priceReqController', ['$scope', '$cookieStore', function($scope, $cookieStore) {
    if ($cookieStore.get('requestedItems') === undefined) {
      $scope.requestedItems = [];
    } else {
      $scope.requestedItems = $cookieStore.get('requestedItems');
    }

    $scope.removeItem = function(idx) {
      $scope.requestedItems.splice(idx, 1);
      $cookieStore.put('requestedItems',$scope.requestedItems);
    };

  }]);

app.controller('priceAddController', ['$scope', '$cookieStore', function($scope, $cookieStore) {
    $scope.addItemToRequestList = function(requestList, currentItem) {
      console.log($scope.requestedItems);
      $scope.requestedItems.push(currentItem);
      $cookieStore.put('requestedItems',$scope.requestedItems);
    };
  }]);

(function($) {
  $(document).ready(function() {
    if($('.news-items').length) {
      setInterval(function() {
        scrollNewsRight();
      }, 5000);

      $(document).on('click','.latest-news a.slide-left', function() {
        scrollNewsRight();
        return false;
      });

      $(document).on('click','.latest-news a.slide-right', function() {
        scrollNewsLeft();
        return false;
      });
    }

      $(document).on('click','.show-request-list', function() {
        $('.popup-price-window').addClass('visible');
        $('.shade-bg').addClass('visible');
        return false;
      });

      $(document).on('click','.shade-bg', function() {
        $('.popup-price-window').removeClass('visible');
        $('.shade-bg').removeClass('visible');
        return false;
      });

      $(document).on('click','.close-list', function() {
        $('.popup-price-window').removeClass('visible');
        $('.shade-bg').removeClass('visible');
        return false;
      });

    $(document).on('click', '.add-to-request-btn', function(e) {
      console.log(e.pageX);
      console.log(e.pageY);

      $('.item-marker').stop( true, true ).css({'left' : (e.pageX-100)+'px',
                             'top' : (e.pageY-100) + 'px',
                             'opacity' : 0,
                             'width' : '200px',
                             'height' : '200px',
                             'z-index' : '100'
                            })
                       .animate({'opacity':1},100,
                          function() {
                            $('.item-marker').animate({'left' : ($('.items-counter').offset().left+5)+'px',
                                                       'top' : ($('.items-counter').offset().top+5)+'px',
                                                       'width' : '10px',
                                                       'height' : '10px'

                                                      },500, function() {
                                                        //$('.items-counter').text(parseInt($('.items-counter').text()) + 1);
                                                        $('.items-counter').addClass('has-item');
                                                      }).animate({'opacity' : 0}, 2000);
                          });
    });

    if($('.top-slider') !== undefined ) {
      setInterval(function() {
        scrollSliderRight();
      }, 8000);

      $(document).on('click','.top-slider .controls li.control-left a', function() {
        scrollSliderRight();
        return false;
      });

      $(document).on('click','.top-slider .controls li.control-right a', function() {
        scrollSliderRight();
        return false;
      });
    }

    if($('#about-us-accordeon') !== undefined) {
      $(document).on('click', '#about-us-accordeon .control-show', function() {
        console.log(!$(this).hasClass('active'));
        if(!$(this).hasClass('active')) {
          $('#about-us-accordeon .control-show').removeClass('active');
          $('#about-us-accordeon .description').removeClass('active');
          $(this).addClass('active');
          $(this).parent().children('.description').addClass('active');
        } else {
          $('#about-us-accordeon .control-show').removeClass('active');
          $('#about-us-accordeon .description').removeClass('active');
        }
        return false;
      });
    }

    /*$( window ).scroll(function(){
        console.log('scroll = '+$('body').scrollTop());
    });*/

  });

  function scrollNewsLeft() {
    var currentMargin = Math.abs(parseInt($('.news-items').get(0).style.marginLeft));

    if (isNaN(currentMargin)) {
      currentMargin = 100;
    }

    if(currentMargin < 300) {
      $('.news-items').css({'margin-left': '-'+ (currentMargin + 100) + '%'});
    } else {
      $('.news-items').css({'margin-left': 0});
    }

  }

  function scrollNewsRight() {
    var currentMargin = Math.abs(parseInt($('.news-items').get(0).style.marginLeft));

    if (isNaN(currentMargin)) {
      currentMargin = 300;
    }

    if(currentMargin > 0) {
      $('.news-items').css({'margin-left': '-'+ (currentMargin - 100) + '%'});
    } else {
      $('.news-items').css({'margin-left': '-300%'});
    }

  }

  function scrollSliderRight() {
    var activeSlide = $('.top-slider ul.slides li.active');
    var nextSlide = (activeSlide.next().length > 0) ? activeSlide.next() : $('.top-slider ul.slides li:first');
    activeSlide.removeClass('active');
    nextSlide.addClass('active');
  }

}(jQuery));


var cubes, list, math, myFirsobject, num, number, opposite, race, square, testWritingFunction,
  slice = [].slice;

number = 42;

opposite = true;

if (opposite) {
  number = -42;
}

square = function(x) {
  return x * x;
};

list = [1, 2, 3, 4];

math = {
  root: Math.sqrt,
  square: square,
  cube: function(x) {
    return x * square(x);
  }
};

race = function() {
  var runners, winner;
  winner = arguments[0], runners = 2 <= arguments.length ? slice.call(arguments, 1) : [];
  return print(winner, runners);
};

if (typeof elvis !== "undefined" && elvis !== null) {
  alert("I knew it!");
}

cubes = (function() {
  var i, len, results;
  results = [];
  for (i = 0, len = list.length; i < len; i++) {
    num = list[i];
    results.push(math.cube(num));
  }
  return results;
})();

testWritingFunction = function(a, b, c, d, e) {
  if (d == null) {
    d = 'test';
  }
  if (e == null) {
    e = [1, 2, 3, 4, 5];
  }
  return "Bla bla bla " + d + " " + c;
};

myFirsobject = {
  brother: {
    name: "Max",
    age: 20
  },
  sister: {
    name: "Ida",
    age: 20
  }
};
