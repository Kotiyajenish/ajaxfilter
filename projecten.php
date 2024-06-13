<?php 

/* Template Name: Projecten*/
get_header();

$totalCount = '';
?>
<section class="projecten ">
    <div class="container">
         <?php echo get_the_content(); ?>
         <div class="filter-add">
            <h5>FILTER</h5>
            <div class="cat-list_item">
                <a href="<?php echo home_url('/projecten/'); ?>">Alle projecten</a>
            </div>
            <ul id="category_post">
            <?php
            $args = array(
                'taxonomy' => 'category',
            );
            $cats = get_categories($args);
            foreach($cats as $cat) { ?>
                <li class="cat-list_item">
                    <?php $category_link = get_category_link( $cat->term_id ); ?>
                    <a href="<?php echo esc_url( $category_link ); ?>" id="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></a>
                </li>
            <?php } ?>
            </ul>
         </div>
         <div class="latest_post" id="latest_post" data-count='3'>
            <?php
            $args = array (
                'post_type' => 'post',
                'posts_per_page' => 6,
                'post_status' => 'publish',
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
            $totalCount = $loop->found_posts;
            $post_tags = get_the_tags( $loop->ID ); ?>
                <div class="post_box">
                    <a href="<?php echo get_the_permalink();?>"><?php echo get_the_post_thumbnail( $post_id, 'large' );?></a>
                    <a href="<?php echo get_the_permalink(); ?>" class="post_title title-post-project"><?php echo get_the_title();?></a>
                    <p class="post_content"></p><?php echo the_excerpt();?>
                </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
        </div>
        <?php if($totalCount > 6) { ?>
            <div class="more-info" id="load-more">
                <a href="javascript:void(0)" id="MorePosts">Meer projecten +</a>
            </div>
        <?php } ?>
    </div>
</section>
<script>

     jQuery(document).ready(function ($) {

        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        //var posttype = "<?php //echo $post_type;?>";
        //var taxonomy = "<?php //echo $taxonomy;?>";

        jQuery('#category_post a').on("click", function (e) {

            var cat = $(this).attr('id');
            jQuery("#MorePosts").hide();
                $.ajax({
                    type: "POST",
                    dateType : "html",
                    url: ajaxurl,
                    data: ({
                        action: 'cat_fliter',
                        cat:cat,
                        // post_type:posttype,
                        // taxonomy:taxonomy,
                    }),
                    success: function (response) {
                        jQuery("#latest_post").html(response);
                    }
                });
            });

        // Load More
        var ppp = 6; // Post per page
		var pageNumber = 1;

        function load_posts(){
            pageNumber++;
		    var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
            $.ajax({
                type: "POST",
                dataType: "html",
		        url: ajaxurl,
                // url: ajax_posts.ajaxurl,
                data: str,
                success: function(data){
		            var $data = $(data);
		            if($data.length){
		                $("#latest_post").append($data);
		            } else{
		                $("#MorePosts").attr("disabled",true);
		            }
		        },
		        error : function(jqXHR, textStatus, errorThrown) {
		            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		        }
            });
            return false;
        }

        $("#MorePosts").on("click",function(){
		    $("#MorePosts").attr("disabled",true);
		    load_posts();
		});

     });
</script>
<?php get_footer();?>