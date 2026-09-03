@extends('layouts.admin')
@section('title', isset($video) ? 'Edit Video' : 'Add Video')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-700 mb-0">{{ isset($video) ? 'Edit Patient Story Video' : 'Add Patient Story Video' }}</h5>
    <a href="{{ route('admin.patient-videos.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<form method="POST"
      action="{{ isset($video) ? route('admin.patient-videos.update', $video) : route('admin.patient-videos.store') }}"
      enctype="multipart/form-data">

    @csrf
    @isset($video) @method('PUT') @endisset

    <div class="row g-4">

        {{-- YouTube source --}}
        <div class="col-xl-8">
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">YouTube Source</h6>

                <div class="mb-3">
                    <label class="form-label">YouTube Video ID <span class="text-danger">*</span></label>
                    <input type="text" name="youtube_id" class="form-control @error('youtube_id') is-invalid @enderror"
                           value="{{ old('youtube_id', $video->youtube_id ?? '') }}"
                           placeholder="e.g. vrF2ciqFfrg (the part after v= in the YouTube URL)">
                    @error('youtube_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Thumbnail is pulled automatically from YouTube unless you upload a custom one below.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Custom Thumbnail (optional)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="form-control @error('thumbnail') is-invalid @enderror">
                    @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                @if(isset($video) && $video->thumbnail)
                    <img src="{{ $video->thumbnail_url }}" class="img-fluid rounded border" style="max-height:180px; object-fit:cover;">
                @endif
            </div>

            {{-- Card content --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Homepage Card</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Topic Label <span class="text-danger">*</span></label>
                        <input type="text" name="topic_label" class="form-control @error('topic_label') is-invalid @enderror"
                               value="{{ old('topic_label', $video->topic_label ?? '') }}" placeholder="e.g. Veteran Testimonial">
                        @error('topic_label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category Badge</label>
                        <input type="text" name="badge" class="form-control @error('badge') is-invalid @enderror"
                               value="{{ old('badge', $video->badge ?? 'Patient Story') }}" placeholder="e.g. Patient Story">
                        @error('badge') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Card Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $video->title ?? '') }}" placeholder="e.g. Clear Speech Restored for Veteran">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Card Description <span class="text-danger">*</span></label>
                        <textarea name="card_description" rows="2" class="form-control @error('card_description') is-invalid @enderror"
                                  placeholder="Short 1-2 line description shown on the card">{{ old('card_description', $video->card_description ?? '') }}</textarea>
                        @error('card_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control" value="{{ old('duration', $video->duration ?? '') }}" placeholder="e.g. 3:12">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $video->location ?? '') }}" placeholder="e.g. Noida Clinic">
                    </div>
                </div>
            </div>

            {{-- Modal content --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Video Player Popup (optional overrides)</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Title</label>
                        <input type="text" name="modal_title" class="form-control" value="{{ old('modal_title', $video->modal_title ?? '') }}" placeholder="Defaults to card title if left blank">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Popup Badge</label>
                        <input type="text" name="modal_badge" class="form-control" value="{{ old('modal_badge', $video->modal_badge ?? '') }}" placeholder="Defaults to category badge">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Speaker / Patient Name</label>
                        <input type="text" name="speaker" class="form-control" value="{{ old('speaker', $video->speaker ?? '') }}" placeholder="e.g. Wg Cdr S.K. Bhatia (Shaurya Chakra)">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Full Description</label>
                        <textarea name="modal_description" rows="3" class="form-control"
                                  placeholder="Defaults to card description if left blank">{{ old('modal_description', $video->modal_description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right column --}}
        <div class="col-xl-4">
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Display</h6>

                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $video->sort_order ?? 0) }}">
                    <div class="form-text">Lower numbers appear first (max 4 shown on homepage).</div>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="isActive" name="is_active" value="1"
                           {{ old('is_active', $video->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Show on homepage</label>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary text-white w-100 py-2">
                <i class="bi bi-check2-circle me-2"></i>
                {{ isset($video) ? 'Update Video' : 'Create Video' }}
            </button>
        </div>

    </div>

</form>

@endsection
