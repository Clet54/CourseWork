<?php
    namespace Clet\Views;

    use Clet\Abstracts\View;
    use Clet\Model\Posts;
    /**
     * The home page view
     */
    class Home extends View
    {
        /**
         * @var \Clet\Model\Posts|null
         */
        public ?Posts $posts = null;
        /**
         * We can handle our self
         *
         * @return string
         */
        public function __toString()
        : string
        {
            return $this->render($this->get_post());
        }
        /**
         * @inheritDoc
         */
        public function render(Posts $post = null)
        : string
        {
            $posts = !empty($post) ? $post : $this->get_post();

            return "
    <main class='container-fluid text-capitalize {$posts->get_slug()}'>
      <div id='carouselExampleDark' class='carousel carousel-dark slide mx-auto w-75' data-bs-ride='carousel'>
        <div class='carousel-indicators'>
          <button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
          <button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='1' aria-label='Slide 2'></button>
          <button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='2' aria-label='Slide 3'></button>
        </div>
        <div class='carousel-inner'>
          <div class='carousel-item active first' data-bs-interval='2000'>
            <div class='carousel-caption d-none d-sm-block'>
              <h5>Jollof rice</h5>
              <p>Just as rice is a staple in many Asian and Latin American countries, it is in Nigeria, too. Jollof rice, at its core, is rice cooked with tomato, onion, pepper, and spices.</p>
            </div>
          </div>
          <div class='carousel-item second' data-bs-interval='2000'>
            <div class='carousel-caption d-none d-sm-block'>
              <h5>Oxtail Peppersoup Recipe</h5>
              <p>SPeppersoup is a popular traditional foods in Nigeria. Follow this handy prep guide to learn to make this this delicious oxtail peppersoup recipe.</p>
            </div>
          </div>
          <div class='carousel-item third'>
            <div class='carousel-caption d-none d-sm-block'>
              <h5>Fresh Okro soup</h5>
              <p>Okro soup, Okra soup, Lady's finger or gumbo..mouthwateringly delicious.mucilaginous in a good way, cheap, fresh.one of Nigeria's national dishes.</p>
            </div>
          </div>
        </div>
        <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Previous</span>
        </button>
        <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Next</span>
        </button>
      </div>
      <div class='text-center text-success fst-italic mx-auto my-5 w-75'>Visiting Nigeria for the first time has a rich and diverse cuisine with various types of cooked foods that are influenced by its many ethnic groups and regions. Some of the most popular If you’re tired of the same old, let’s take a culinary journey to the west coast of Africa. Nigerian Food is aromatic, colourful, and full of flavour. Besides jollof rice and fufu, there are many delicious staples. From hearty and rich stews and soups to savoury staples, you’ll enjoy every single bite of these traditional meals</div>
      <h3 class='display-3'>WHAT IS A TYPICAL NAIJA MEAL LIKE?</h3>
      <p class='lead mx-5'><strong class='fw-bolder'>Foods in Nigeria</strong>: Nigerian Recipes – Nigerian Food
      Nigerians love to eat, and they are known for their food. Nigerian food is very diverse, from the different regions in Nigeria to the various tribes that call Nigeria home. With this diversity comes a lot of recipes—and we’re here to help you find them!</p>
      <div class='row g-4 mt-3'>
        <div class='col col-sm-12 col-md-4'>
          <div class='card'>
            <img src='{$posts::get_assets_url('/images/792.jpeg')}' class='card-img-top' alt='...'>
            <div class='card-body'>
              <h5 class='card-title text-capitalize'>Egusi soup</h5>
              <p class='card-text'>Egusi soup is a Nigerian delicacy that features ground melon or pumpkin seeds as its main ingredient.</p>
              <p class='card-text'>Other ingredients include meat or seafood, fermented beans, onions, and vegetables.</p>
              <p class='card-text'>The combination of ingredients makes for a flavorful soup.</p>
              <p class='card-text'>Thanks to the pumpkin seeds (egusi), this soup has a wonderful nuttiness to it. The rest of the ingredients add salty, savory, and spicy flavors as well.</p>
              <p class='card-text'>The hearty soup is most commonly eaten with pounded yam, which is a dough-based dish made of, surprise – pounded yam..</p>
            </div>
          </div>
        </div>
        <div class='col col-sm-12 col-md-4'>
          <div class='card'>
            <img src='{$posts::get_assets_url('/images/791.jpeg')}' class='card-img-top' alt='...'>
            <div class='card-body'>
              <h5 class='card-title text-capitalize'>Oxtail peppersoup</h5>
              <p class='card-text'>Peppersoup is a popular traditional foods in Nigeria</p>
              <p class='card-text'> 
Oxtail peppersoup is one of the most well liked of recent trending meals in the world. It is easy, it's quick, it tastes yummy. It's appreciated by millions every day. 
Oxtail peppersoup is something which I've loved my entire life. They're nice and they look wonderful.
</p>
            </div>
          </div>
        </div>
        <div class='col col-sm-12 col-md-4'>
          <div class='card'>
            <img src='{$posts::get_assets_url('/images/789.jpeg')}' class='card-img-top' alt='...'>
            <div class='card-body'>
              <h5 class='card-title text-capitalize'>Jollof Rice</h5>
              <p class='card-text'>Jollof, or jollof rice, is a rice dish from West Africa. The dish is typically made with long-grain rice, tomatoes, onions, spices, vegetables and meat in a single pot, although its ingredients and preparation methods vary across different regions.</p>
              <p class='card-text'>As many Asian and Latin American countries, it is in Nigeria, too. Jollof rice, at its core, is rice cooked with tomato, onion, pepper, and spices.</p>
            </div>
          </div>
        </div>
      </div>
    </main>
    ";
        }
        /**
         * @inheritDoc
         */
        public function __construct(object|array $defaults = []) { parent::__construct($defaults); }
    }
