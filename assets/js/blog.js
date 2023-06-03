// swiper initialization
var mySwiper = new Swiper('.swiper-container', {
    direction: 'vertical',
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    keyboard: {
      enabled: true,
    },
    lazy: {
      loadPrevNext: true,
      loadPrevNextAmount: 2,
      loadOnTransitionStart: true
    }
  });
  
  
//   some global variables

  // Get a reference to the "Load More" button by ID
  const loadMoreBtn = document.getElementById('load-more-btn');
  
  // Get a reference to the swiper container by class name
  const swiperContainer = document.querySelector('.swiper-container');
  
  // Get a reference to the swiper wrapper container by class name
  const swiperWrapper = document.querySelector('.swiper-wrapper');
  
  // initial blogs
  
  $(document).ready(function() {
    // Make an AJAX request to get_new_blogs.php
    fetch('get_new_blogs.php')
      .then(response => response.json())
      .then(newBlogs => {
        // Create a new HTML string for the new blog data
        const newBlogHtml = newBlogs.map(blog => `
          <div class="swiper-slide">
            <div class="w3-padding">
              <img src="${blog.image}" class="w3-round-xlarge content-img"><br><br>
              <span class="w3-card w3-small w3-padding w3-round-xxlarge">Author</span><br>
              <p class="w3-margin">${blog.content}</p>
            </div>
          </div>
        `).join('');
  
        // Append the new blog HTML to the swiper wrapper container
        swiperWrapper.insertAdjacentHTML('beforeend', newBlogHtml);
  
        // Update the swiper instance with the new content
        swiperContainer.swiper.update();
      })
      .catch(error => console.error(error));
  });
  
  
  
  
  
  // load more
  
  loadMoreBtn.addEventListener('click', () => {
    // Make an AJAX call to get the new blog data
    fetch('get_new_blogs.php')
      .then(response => response.json())
      .then(newBlogs => {
        // Create a new HTML string for the new blog data
        const newBlogHtml = newBlogs.map(blog => `
          <div class="swiper-slide">
            <div class="w3-padding">
              <img src="${blog.image}" class="w3-round-xlarge content-img" >
              <p class="w3-margin">${blog.content}</p>
              
            </div>
          </div>
        `).join('');
  
        // Append the new blog HTML to the swiper wrapper container
        swiperWrapper.insertAdjacentHTML('beforeend', newBlogHtml);
  
        // Update the swiper instance with the new content
        swiperContainer.swiper.update();
      })
      .catch(error => console.error(error));
  });
  