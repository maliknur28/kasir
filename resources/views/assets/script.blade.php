<script>
    $(document).ready(function() {
        // get product
        $('#id_product').on('change', function() {
            const id_product = $(this).val();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "{{ route('get.product') }}",
                data: {
                    id_product: id_product
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    $('#name').val(response.data.name);
                    $('#price').val(response.data.price);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // get discount
        $('#id_member').on('change', function() {
            const id_member = $(this).val();
            const subtotal = parseFloat($('#total_price')
                .val());
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "{{ route('get.discount') }}",
                data: {
                    id_member: id_member,
                    subtotal: subtotal
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.total_discount) {
                        $('#discount').val(response.total_discount);
                        const percent = parseFloat(response.total_discount);
                        const discount = subtotal * (percent / 100)
                        const total = subtotal - discount;
                        $('#total_price').val(total);
                    } else {
                        $('#discount').val(0);
                        $('#total_price').val(subtotal);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // count subtotal
        function countSubtotal() {
            const price = parseFloat($('#price').val());
            const qty = parseFloat($('#qty').val());

            if (!isNaN(price) && !isNaN(qty)) {
                const subtotal = price * qty;
                $('#subtotal').val(subtotal);
            }
        }
        $('#price, #qty').keyup(countSubtotal);

        // count total harga
        function getTotal() {
            const totalValue = $("#total").text().trim();
            $("#total_price").val(totalValue);
        }
        getTotal();

        // count back
        function countBack() {
            const pay = parseFloat($('#pay').val());
            const total = parseFloat($('#total_price').val());
            const back = pay - total;

            $('#back').val(back);
        }
        $('#pay').keyup(countBack);

        // function while payless
        function validatePayment() {
            const totalPrice = parseFloat($('#total_price').val());
            const payAmount = parseFloat($('#pay').val());
            const returnAmount = payAmount - totalPrice;

            $('#back').val(returnAmount);

            if (payAmount < totalPrice || isNaN(returnAmount)) {
                $('#btnPay').prop('disabled', true);
            } else {
                $('#btnPay').prop('disabled', false);
            }
        }
        $('#pay').keyup(validatePayment);

        // function print report
        function print() {
            const printContents = $("#table-print").html();
            const originalContents = $("body").html();
            $("body").html(printContents);
            window.print();
            $("body").html(originalContents);
        }
        $('#print').on('click', print);
    });
</script>
