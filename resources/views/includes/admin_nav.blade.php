<div class="border-end">
    <p class="fs-4 text-red fw-semibold border-bottom pb-3">Панель администратора</p>
    <ul class="d-flex flex-column gap-4 p-0" style="list-style-type: none">
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('orders') }}">
                Заказы
            </a>
        </li>
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('products') }}">
                Товары
            </a>
        </li>
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('categories') }}">
                Категории
            </a>
        </li>
        <li>
            <a class="text-decoration-none fs-5 text-black" href="{{ route('actions') }}">
                Акции
            </a>
        </li>
    </ul>
</div>
