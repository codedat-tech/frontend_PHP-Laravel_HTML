<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interior Design Gallery</title>

    <link rel="stylesheet" href="{{ url('Asset/css/interior-design.css') }}">
</head>

<body>
    <header>
        <h1>Interior Design Gallery</h1>
    </header>

    <div class="menu">
        <div class="menu-item" onclick="toggleSection('modern')">Modern Style</div>
        <div class="menu-item" onclick="toggleSection('classic')">Classic Style</div>
    </div>


    <div class="style-section" id="modern">
        <h2>Modern Style</h2>
        <div class="gallery">
            @foreach($blueprints as $blueprint)
                @if($blueprint->categoryDesign->name == 'Bathroom')
                    <div class="gallery-item">
                        <img src="{{ url('Asset/Image/gallery/' . $blueprint->image) }}" alt="{{ $blueprint->name }}" class="main-image" onclick="showDetails('modern-{{ $blueprint->blueprintID }}-details')">
                        <h3>{{ $blueprint->name }}</h3>
                        <div class="details" id="modern-{{ $blueprint->blueprintID }}-details">
                            <p>{{ $blueprint->description }}</p>
                            <img src="{{ url('Asset/Image/gallery/' . $blueprint->image) }}" alt="{{ $blueprint->name }}" width="100%">
                            <!-- Additional images can be added here if available -->
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="style-section" id="classic" style="display:none;">
        <h2>Classic Style</h2>
        <div class="gallery">
            @foreach($blueprints as $blueprint)
                @if($blueprint->categoryDesign->name == 'Kitchen')
                    <div class="gallery-item">
                        <img src="{{ url('Asset/Image/gallery/' . $blueprint->image) }}" alt="{{ $blueprint->name }}" class="main-image" onclick="showDetails('classic-{{ $blueprint->blueprintID }}-details')">
                        <h3>{{ $blueprint->name }}</h3>
                        <div class="details" id="classic-{{ $blueprint->blueprintID }}-details">
                            <p>{{ $blueprint->description }}</p>
                            <img src="{{ url('Asset/Image/gallery/' . $blueprint->image) }}" alt="{{ $blueprint->name }}" width="100%">
                            <!-- Additional images can be added here if available -->
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script>
        function toggleSection(sectionId) {
            const sections = document.querySelectorAll('.style-section');
            sections.forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        function showDetails(detailId) {
            const details = document.querySelectorAll('.details');
            details.forEach(detail => {
                detail.style.display = 'none';
            });
            document.getElementById(detailId).style.display = 'block';
        }
    </script>
</body>

</html>
