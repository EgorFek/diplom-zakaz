<div class="col-12 col-lg-4 border-end">
    <p class="fs-4 text-red fw-semibold border-bottom pb-3">Мой аккаунт</p>
    <ul class="d-flex flex-column gap-4 p-0" style="list-style-type: none">
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('profile') }}">
                Профиль
            </a>
        </li>
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('profile.orders') }}">
                Заказы
            </a>
        </li>
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('logout') }}">
                Выход
            </a>
        </li>
    </ul>
</div>
