<?php include("includes/header.php"); ?>

<?php

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$item_per_page = 8;
$items_total_count = Photo::count_all();

$paginate = new Paginate($page,$item_per_page,$items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= " LIMIT {$item_per_page} ";
$sql .= " OFFSET {$paginate->offset()} ";
$photos = Photo::find_by_query($sql);

?>
    <!-- MAIN -->
    <main>
      <!-- SECTION GALLERY -->
      <section class="section-testimonials" id="testimonials">
        <div class="testimonials-container">
          <span class="subheading">Photo gallery</span>
          <h2 class="heading-secondary">Latest photos</h2>

        <div class="gallery">
        <?php  foreach ($photos as $photo): ?>
          <figure class="gallery-item">
            <a href="photo_view.php?id=<?php echo $photo->photo_id ?>">
            <img
              src="admin/<?php echo $photo->picture_path() ?>"
              alt="A nice photo"
            />
            </a>
            <!-- <figcaption>Caption</figcaption> -->
          </figure>
          <?php endforeach; ?>  
        </div>
        <div class="pagination">
          <?php
          if($paginate->page_total() > 1) {

            if($paginate->has_previous()){
              echo " <a href='gallery.php?page={$paginate->previous()}'>
                        <button class='btn-pagination'>
                          <svg xmlns='http://www.w3.org/2000/svg' class='btn-icon'
                          fill='none'
                          viewBox='0 0 24 24'
                          stroke='currentColor'>
                            <path
                              stroke-linecap='round'
                              stroke-linejoin='round'
                              stroke-width='2'
                              d='M15 19l-7-7 7-7'/>
                          </svg>
                        </button>
                      </a>";
            }

            for ($i=1; $i <= $paginate->page_total() ; $i++) { 
                if($i == $paginate->current_page){
                    echo "<a class='page-link page-link--current' href='gallery.php?page={$i}'>{$i}</a>";
                } else {
                    echo "<a class='page-link' href='gallery.php?page={$i}'>{$i}</a>";
                }
            }

            if($paginate->has_next()){
              echo " <a href='gallery.php?page={$paginate->next()}'>
              <button class='btn-pagination'>
              <svg
                xmlns='http://www.w3.org/2000/svg'
                class='btn-icon'
                fill='none'
                viewBox='0 0 24 24'
                stroke='currentColor'
              >
                <path
                  stroke-linecap='round'
                  stroke-linejoin='round'
                  stroke-width='2'
                  d='M9 5l7 7-7 7'
                />
              </svg>
            </button>
            </a>"
            ;
          }
        }
        ?>
        </div>
      
    </main>
  </body>
</html>
