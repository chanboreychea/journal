<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @foreach ($data as $accountType => $items)
        <ul>
            <li>{{ $accountType }}</li>
            @foreach ($items as $item => $accountName)
                <ul>
                    <li>{{ $item }}</li>
                    @foreach ($accountName as $name)
                        <div>- {{ $name }}</div>
                    @endforeach
                </ul>
            @endforeach
        </ul>
    @endforeach

</div>
