@if ($row->images && $row->images->count() > 0)
    <img src="{{ asset('uploads/products/' . $row->images->first()->file_name) }}" width="50" height="50"
         class="img-thumbnail" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
    <span class="text-muted" style="display:none;">No Image</span>
@else
    <span class="text-muted">No Image</span>
@endif
