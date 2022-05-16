<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dota 2 - AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <style>
        /* body {
            color: #f7f7f7;
            background-color: #1a1a1a;
        } */
    </style>
</head>

<body>
    <div class="container mt-5">
        <h4 class="mb-3">გმირის პოზიცია</h4>
        <form class="needs-validation" method="get" action="/positions/create">
            <select class="form-select mb-3" name="hero" required>
                @foreach ($heroes as $hero)
                <option value="{{ $hero->id }}" {{ session()->get('values.hero_id') == $hero->id ? "selected" : "" }}>{{ $hero->name }}</option>
                @endforeach
            </select>
            <div class="ranks mb-3">
                @foreach ($ranks as $rank)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="ranks[]" type="checkbox" id="rankCheckbox-{{ $rank->id }}" value="{{ $rank->id }}" {{ session()->has('values') && in_array($rank->id, session()->get('values.ranks')) ? "checked" : "" }}>
                    <label class="form-check-label" for="rankCheckbox-{{ $rank->id }}">{{ $rank->title }}</label>
                </div>
                @endforeach
            </div>
            <div class="positions mb-3">
                @foreach ($positions as $position)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="positions[]" type="checkbox" id="positionsCheckbox-{{ $position->position }}" value="{{ $position->position }}" {{ session()->has('values') && in_array($position->position, session()->get('values.positions')) ? "checked" : "" }}>
                    <label class="form-check-label" for="positionsCheckbox-{{ $position->position }}">{{ $position->title }}</label>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mb-5">გაგზავნა</button>
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    {{ $error }}
                </div>
            </div>
            @endforeach
            @endif
            @csrf
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

</body>

</html>