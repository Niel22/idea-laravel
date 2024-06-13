<div class="d-flex justify-content-start">
    <p class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
        </span> {{ count($user->followers) }} Followers </p>
    <p class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
        </span> {{ count($user->ideas) }} </p>
    <p class="fw-light nav-link fs-6 me-3"> <span class="fas fa-comment me-1">
        </span>  {{ count($user->comments) }}  </p>
    <p class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
        </span>  {{ count($user->likes) }}  </p>
</div>