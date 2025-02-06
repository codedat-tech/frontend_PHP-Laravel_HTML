@extends('layouts.index')
@section('content')
    <section class="interior-design">
        <div class="menu2">
            <div class="menu2-item" onclick="toggleSection('modern')">Modern Style</div>
            <div class="menu2-item" onclick="toggleSection('classic')">Classic Style</div>
        </div>
        <div class="style-section" id="modern">
            <h2>Modern Style</h2>
            <div class="gallery2">
                @foreach ($blueprints as $blueprint)
                    @if ($blueprint->categoryDesign && $blueprint->categoryDesign->name == 'Modern')
                        <div class="gallery2-item">
                            <img src="{{ asset('Asset/Image/blueprint/' . $blueprint->image) }}"
                                alt="{{ $blueprint->name }}" class="main-image"
                                onclick="showDetails('modern-{{ $blueprint->blueprintID }}-details')">

                            <h3>{{ $blueprint->name }}</h3>
                            <div class="details2" id="modern-{{ $blueprint->blueprintID }}-details">
                                <p>{{ $blueprint->description }}</p>
                                <img src="{{ url('/Asset/Image/blueprint/' . $blueprint->image) }}"
                                    alt="{{ $blueprint->name }}" width="100%">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="style-section" id="classic" style="display:none;">
            <h2>Classic Style</h2>
            <div class="gallery2">
                @foreach ($blueprints as $blueprint)
                    @if ($blueprint->categoryDesign && $blueprint->categoryDesign->name == 'Scandinavian')
                        <div class="gallery2-item">
                            @if ($blueprint->image)
                                <img src="{{ url('/Asset/Image/blueprint/' . $blueprint->image) }}"
                                    alt="{{ $blueprint->name }}" class="main-image"
                                    onclick="showDetails('classic-{{ $blueprint->blueprintID }}-details')">
                            @else
                                <p>No image available</p>
                            @endif
                            <h3>{{ $blueprint->name }}</h3>
                            <h1>thấy ghét</h1>
                            <div class="details2" id="classic-{{ $blueprint->blueprintID }}-details">
                                <p>{{ $blueprint->description }}</p>
                                @if ($blueprint->image)
                                    <img src="{{ url('Asset/Image/blueprint/' . $blueprint->image) }}"
                                        alt="{{ $blueprint->name }}" width="100%">
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>
    <script>
        function toggleSection(sectionId) {
            const sections = document.querySelectorAll('.style-section');
            sections.forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        function showDetails(detailId) {
            const details = document.querySelectorAll('.details2');
            details.forEach(detail => {
                detail.style.display = 'none';
            });
            const detailElement = document.getElementById(detailId);
            if (detailElement) {
                detailElement.style.display = 'block';
            }
        }
    </script>
@endsection
