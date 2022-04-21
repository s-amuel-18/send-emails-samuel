   {{-- whatsapp --}}
   @if ($whatsapp)
       <a target="_blanck" href="{{ $whatsapp }}" class="btn btn-success btn-sm ">
           <i class="fab fa-whatsapp"></i>
       </a>
   @endif

   {{-- facebook --}}
   @if ($facebook)
       <a target="_blanck" href="{{ $facebook }}"
           class="btn btn-primary btn-sm {{ !$facebook ? 'disabled' : '' }}">
           <i class="fab fa-facebook"></i>
       </a>
   @endif

   {{-- instagram --}}
   @if ($instagram)
       <a target="_blanck" href="{{ $instagram }}"
           class="btn btn-danger btn-sm {{ !$instagram ? 'disabled' : '' }}">
           <i class="fab fa-instagram"></i>
       </a>
   @endif

   {{-- url --}}
   @if ($url)
       <a target="_blanck" href="{{ $url }}" class="btn btn-info btn-sm {{ !$url ? 'disabled' : '' }}">
           <i class="fas fa-external-link-alt"></i>
       </a>
   @endif
