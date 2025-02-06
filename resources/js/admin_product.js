// $(document).ready(function ()
// {
//     // 1. Product Name && duplicate
//     const checkName = () =>
//     {
//         const name = $('#name').val();
//         if (name.length < 5)
//         {
//             $('#name-error').text('Product name must be at least 5 characters.');
//         } else
//         {
//             $('#name-error').text('');
//             // duplicate with Ajax
//             $.ajax({
//                 url: "{{ route('products.checkName') }}",
//                 method: 'POST',
//                 data: {
//                     name: name,
//                     _token: '{{ csrf_token() }}'
//                 },
//                 success: function (response)
//                 {
//                     if (response.exists)
//                     {
//                         $('#name-error').text('Product name already exists.');
//                     } else
//                     {
//                         $('#name-error').text('');
//                     }
//                 },
//                 error: function ()
//                 {
//                     $('#name-error').text('Error checking product name.');
//                 }
//             });
//         }
//     };
//     checkName();
//     $('#name').on('input', checkName);

//     // 2. Image check
//     const checkImage = () =>
//     {
//         const file = $('input[name="image"]')[0].files[0];
//         const fileName = file ? file.name : '';
//         const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

//         if (!allowedExtensions.exec(fileName))
//         {
//             $('#image-error').text('Nullable. Only JPG, JPEG, PNG, and GIF files are allowed.');
//             $('input[name="image"]').val(''); // Clear input
//             return;
//         } else
//         {
//             $('#image-error').text('');
//         }

//         //Ajax
//         $.ajax({
//             url: "{{ route('products.checkImageName') }}",
//             method: 'POST',
//             data: {
//                 imageName: fileName,
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function (response)
//             {
//                 if (response.exists)
//                 {
//                     $('#image-error').text(
//                         'Image with this name already exists. Please rename your file.'
//                     );
//                 } else
//                 {
//                     $('#image-error').text('');
//                 }
//             },
//             error: function ()
//             {
//                 $('#image-error').text('Error checking image name.');
//             }
//         });
//     };
//     checkImage();
//     $('input[name="image"]').on('change', checkImage);

//     // 3.Price check
//     const checkPrice = () =>
//     {
//         const price = parseFloat($('#price').val());
//         if (isNaN(price) || price <= 0)
//         {
//             $('#price-error').text('Price must be a positive number.');
//         } else
//         {
//             $('#price-error').text('');
//         }
//     };
//     checkPrice();
//     $('#price').on('input', checkPrice);

//     // 4. Quantity In Stock > 0
//     const checkQuantityInStock = () =>
//     {
//         const quantity = parseInt($('#quantityInStock').val());
//         if (isNaN(quantity) || quantity <= 0)
//         {
//             $('#quantity-error').text('Quantity in stock must be a positive integer.');
//         } else
//         {
//             $('#quantity-error').text('');
//         }
//     };
//     checkQuantityInStock();
//     $('#quantityInStock').on('input', checkQuantityInStock);

//     // 5. Quantity In Stock >= InStocked > 0
//     const checkInStocked = () =>
//     {
//         const instocked = parseInt($('#InStocked').val());
//         const quantity = parseInt($('#quantityInStock').val());
//         if (isNaN(instocked) || instocked <= 0)
//         {
//             $('#instock-error').text('Quantity must be a positive integer.');
//         } else if (instocked > quantity)
//         {
//             $('#instock-error').text(
//                 'Quantity in stock cannot be greater than the available quantity.');
//         } else
//         {
//             $('#instock-error').text('');
//         }
//     };
//     checkInStocked();
//     $('#InStocked').on('input', checkInStocked);

//     // 6. Category được chọn
//     const checkCategory = () =>
//     {
//         if ($('#categoryID').val() === "")
//         {
//             $('#category-error').text('Please select a category.');
//         } else
//         {
//             $('#category-error').text('');
//         }
//     };
//     checkCategory();
//     $('#categoryID').on('change', checkCategory);

//     // 7. Brand được chọn
//     const checkBrand = () =>
//     {
//         if ($('#brandID').val() === "")
//         {
//             $('#brand-error').text('Please select a brand.');
//         } else
//         {
//             $('#brand-error').text('');
//         }
//     };
//     checkBrand();
//     $('#brandID').on('change', checkBrand);

//     // 8. Description
//     const checkDescription = () =>
//     {
//         if ($('#description').val().trim() === "")
//         {
//             $('#description-error').text('Description cannot be empty.');
//         } else
//         {
//             $('#description-error').text('');
//         }
//     };
//     checkDescription();
//     $('#description').on('input', checkDescription);
// });