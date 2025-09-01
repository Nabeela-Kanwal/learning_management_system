      <style>
          .cat__img-wrapper {
              width: 100%;
              height: 250px;
              overflow: hidden;
              border-radius: 8px;

          }

          .cat__img-wrapper img {
              width: 100%;
              height: 100%;
              object-fit: cover;
          }

          .category-item {
              margin-bottom: 30px;
          }
      </style>
      <div class="category-wrapper">
          <div class="row">
              @foreach ($categories as $category)
                  <div class="col-lg-4 responsive-column-half">
                      <div class="category-item">
                          <div class="cat__img-wrapper">
                              <img class="cat__img lazy" src="{{ asset($category->image) }}" alt="Category image">
                          </div>
                          <div class="category-content">
                              <div class="category-inner">
                                  <h3 class="cat__title"><a href="#">{{ $category->name }}</a></h3>
                                  <p class="cat__meta">9 courses</p>
                                  <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">
                                      Explore<i class="la la-arrow-right icon ml-1"></i>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
