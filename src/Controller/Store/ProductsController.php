<?php

namespace App\Controller\Store;

use App\API\Products;
use App\Infrastructure\App;

class ProductsController extends App
{
    /**
     * @throws \JsonException
     */
    public function ProductGrid($product = []): string
    {

        if (empty($product)) {
            return 'Missing product data';
        }
        $image = self::ProductImages($product['product_images']);
        $main_price = "";
        if (!empty($product['discount']) && $product['discount'] > 0):
            $discounted = (int)(($product['discount'] - 0) / 100 * $product['sale_price']);
            $main_price = '<span style="text-decoration:line-through" class="text-muted">' . number_format($product['sale_price']) . '</span>';
            $product['sale_price'] -= $discounted;
        endif;
        return '<div class="col">
                    <div class="card iq-product-custom-card animate:hover-media ">
                    <div class="iq-product-hover-img position-relative animate:hover-media-wrap">
                        <a href="' . BASE_PATH . 'product/' . $product['product_id'] . '">
                            <img src="' . $image . '" alt="product-details" class="img-fluid iq-product-img hover-media" loading="lazy">
                        </a>
                        <div class="iq-product-card-hover-effect-1 iq-product-info">
                            <a href="#"
                               class="btn btn-icon iq-product-btn rounded-pill wishlist-btn">
                            <span class="btn-inner">
                                <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4"
                                          d="M11.7761 21.8374C9.49311 20.4273 7.37081 18.7645 5.44807 16.8796C4.09069 15.5338 3.05404 13.8905 2.41735 12.0753C1.27971 8.53523 2.60399 4.48948 6.30129 3.2884C8.2528 2.67553 10.3752 3.05175 12.0072 4.29983C13.6398 3.05315 15.7616 2.67705 17.7132 3.2884C21.4105 4.48948 22.7436 8.53523 21.606 12.0753C20.9745 13.8888 19.944 15.5319 18.5931 16.8796C16.6686 18.7625 14.5465 20.4251 12.265 21.8374L12.0161 22L11.7761 21.8374Z"
                                          fill="currentColor"></path>
                                    <path d="M12.0109 22.0001L11.776 21.8375C9.49013 20.4275 7.36487 18.7648 5.43902 16.8797C4.0752 15.5357 3.03238 13.8923 2.39052 12.0754C1.26177 8.53532 2.58605 4.48957 6.28335 3.28849C8.23486 2.67562 10.3853 3.05213 12.0109 4.31067V22.0001Z"
                                          fill="currentColor"></path>
                                    <path d="M18.2304 9.99922C18.0296 9.98629 17.8425 9.8859 17.7131 9.72157C17.5836 9.55723 17.5232 9.3434 17.5459 9.13016C17.5677 8.4278 17.168 7.78851 16.5517 7.53977C16.1609 7.43309 15.9243 7.00987 16.022 6.59249C16.1148 6.18182 16.4993 5.92647 16.8858 6.0189C16.9346 6.027 16.9816 6.04468 17.0244 6.07105C18.2601 6.54658 19.0601 7.82641 18.9965 9.22576C18.9944 9.43785 18.9117 9.63998 18.7673 9.78581C18.6229 9.93164 18.4291 10.0087 18.2304 9.99922Z"
                                          fill="currentColor"></path>
                                </svg>
                            </span>
                            </a>
                        </div>
                        <div class="iq-product-card-hover-effect-2 iq-product-info">
                            <a href="javascript:" class="btn btn-icon iq-product-btn rounded-pill cart-btn add-to-cart" data-action="add"
                            data-id="' . $product['product_id'] . '" data-name="' . $product['product_name'] . '" data-price="' . $product['sale_price'] . '" data-image="' . $image . '">
                            <span class="btn-inner">
                                <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                          d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                          fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                          fill="currentColor"></path>
                                </svg>
                            </span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <a href="' . BASE_PATH . 'product/' . $product['product_id'] . '" title="' . ucwords(strtolower($product['product_name'])) . '"
                               class="h6 iq-product-detail mb-0 truncate w-100">' . ucwords(strtolower($product['product_name'])) . '</a>                          
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">' . $this->currency . ' ' . number_format($product['sale_price']) . '</h5> 
                          ' . $main_price . '
                        </div>
                    </div>
                </div>
            </div>';
    }

    /**
     * @throws \JsonException
     */
    public function CategoryShowcase(): array
    {
        $productAPI = new Products();
        $showcase = $productAPI->getCategoryShowcase();
        $categories = [];
        foreach ($showcase as $row) {
            $catId = $row['product_category'];
            $categories[$catId]['category_name'] = $row['category_name'];
            $categories[$catId]['category_id'] = $row['category_table_id'];
            $categories[$catId]['products'][] = [
                'product_id' => $row['id'],
                'product_name' => $row['product_name'],
                'sale_price' => $row['sale_price'],
                'product_images' => ($row['product_images'])
            ];
        }
        return $categories;
    }

    public static function ProductPricing($params = []): array
    {
        return (new Products())->getProductsPricing($params);

    }

    /**
     * @throws \JsonException
     */
    public static function ProductImages($images, $position = 0): string
    {
        $response = NO_IMAGE;
        $directory = 'assets/images/products/';
        if (empty($images)) {
            return $response;
        }
        $images_array = json_decode(htmlspecialchars_decode($images), true, 512, JSON_THROW_ON_ERROR);
        if (empty($position)) {
            if (!empty($images_array[1]) && file_exists($directory . $images_array[1])):
                $response = PRODUCT_IMAGES . ($images_array[1]);
            elseif (!empty($images_array[2]) && file_exists($directory . $images_array[2])):
                $response = PRODUCT_IMAGES . ($images_array[2]);
            elseif (!empty($images_array[3]) && file_exists($directory . $images_array[3])):
                $response = PRODUCT_IMAGES . ($images_array[3]);
            elseif (!empty($images_array[4]) && file_exists($directory . $images_array[4])):
                $response = PRODUCT_IMAGES . ($images_array[4]);
            elseif (!empty($images_array[5]) && file_exists($directory . $images_array[5])):
                $response = PRODUCT_IMAGES . ($images_array[5]);
            endif;
        } else if (!empty($images_array[$position]) && file_exists($directory . $images_array[$position])) {
            $response = PRODUCT_IMAGES . ($images_array[$position]);
        }
        return $response;
    }


}