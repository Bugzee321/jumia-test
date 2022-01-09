<!DOCTYPE html>
<html lang="en">

<head>
    <title>Phone Numbers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="jumbotron text-center">
        <h1>Phone Numbers</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <select class="form-select" name="country" id="country">
                    <option value="">select country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->code }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6">
                <select class="form-select" name="state" id="state">
                    <option value="">valid or not valid</option>
                    <option value="Valid">Valid</option>
                    <option value="Invalid">Not Valid</option>
                </select>
            </div>
            <div class="col-sm-12">
                @include('customers')
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        let page = 1;
        let state = '';
        let country = '';
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            page = $(this).attr('href').split('page=')[1];
            getCustomers();
        });

        function getCustomers() {
            var url = buildUrl(page, country, state);
            $('#paginator').remove()
            $.ajax({
                url: url
            }).done(function(data) {
                $('#table').html(data);
            }).fail(function() {});
        }
        $('#country').on('change', function() {
            country = $(this).val();
            getCustomers();
        });

        $('#state').on('change', function() {
            state = $(this).val();
            getCustomers();
        });

        function buildUrl(page, country, state) {
            return '{{ route('customers.index') }}' + '?page=' + page + '&country=' + country + '&state=' + state;
        }
    </script>
</body>

</html>
