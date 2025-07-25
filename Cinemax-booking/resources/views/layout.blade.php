<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cinemax</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('cinemax/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('cinemax/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

</head>

<body>
    @include('client.block.loading')



    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch"
        aria-labelledby="Search">
        <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="order-md-last">
                <form role="search" action="index.html" method="get" class="d-flex mt-3 gap-0">
                    <input class="form-control rounded-start rounded-0 bg-light" type="email"
                        placeholder="What are you looking for?" aria-label="What are you looking for?">
                    <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
                </form>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Search</span>
                </h4>
            </div>
        </div>
    </div>

    @include('client.block.header')
    @yield('content')
    @include('client.block.footer')
    @include('client.block.footer-bottom')
    <script src="{{ asset('cinemax/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="{{ asset('cinemax/js/plugins.js') }}"></script>
    <script src="{{ asset('cinemax/js/script.js') }}"></script>
    <script>
        function openSeatModal(showtimeId) {
            fetch('/chon-ghe-modal/' + showtimeId)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('seatModalContent').innerHTML = html;

                    let modal = new bootstrap.Modal(document.getElementById('seatModal'));
                    modal.show();

                    initSeatSelection();
                });
        }

        function initSeatSelection() {
            const checkboxes = document.querySelectorAll('input[name="seats[]"]');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("change", function() {
                    const label = document.querySelector(`label[for="${checkbox.id}"]`);

                    if (checkbox.checked) {
                        label.classList.remove("btn-seat-available");
                        label.classList.add("btn-seat-selected");
                    } else {
                        label.classList.remove("btn-seat-selected");
                        label.classList.add("btn-seat-available");
                    }

                    updateSeatInfo();
                });
            });

            function updateSeatInfo() {
                const selected = Array.from(document.querySelectorAll('input[name="seats[]"]:checked'));

                const seatNames = [];
                let total = 0;

                selected.forEach(cb => {
                    const label = document.querySelector(`label[for="${cb.id}"]`);
                    const price = parseInt(cb.getAttribute('data-price')) || 0;
                    total += price;

                    if (label) {
                        seatNames.push(label.textContent.trim());
                    }
                });

                document.getElementById('selected-seats').innerText = seatNames.join(', ') || '---';
                document.getElementById('total-price').innerText = total.toLocaleString('vi-VN') + 'đ';
            }
        }
    </script>
    @section('scripts')
        <script>
            // ===== Ghi lại vị trí scroll trước khi reload hoặc chuyển trang
            window.addEventListener('beforeunload', function() {
                localStorage.setItem('scrollPosition', window.scrollY);
            });

            // ===== Khôi phục vị trí scroll khi load lại trang
            window.addEventListener('load', function() {
                const scrollPosition = localStorage.getItem('scrollPosition');
                if (scrollPosition !== null) {
                    window.scrollTo(0, parseInt(scrollPosition));
                }
            });

            // ===== Load modal ghế
            function openSeatModal(showtimeId) {
                fetch(`/showtime/${showtimeId}/seats`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('seatModalContent').innerHTML = html;
                        const modal = new bootstrap.Modal(document.getElementById('seatModal'));
                        modal.show();
                    });
            }
        </script>
    @endsection

</body>

</html>
