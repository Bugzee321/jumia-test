<div id="load" style="position: relative;">
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">Country</th>
                <th scope="col">State</th>
                <th scope="col">Country Code</th>
                <th scope="col">Phone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->country_name }}</td>
                    <td>{{ $customer->state }}</td>
                    <td>{{ $customer->country_code }}</td>
                    <td>{{ $customer->phone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="paginator">
    {{ $customers->appends(request()->all())->links('pagination::default') }}
</div>
