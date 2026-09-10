<footer class="site-footer bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        {{-- Верхняя часть: колонки ссылок --}}
        <div class="row g-4">
            
            {{-- Колонка 1: О магазине --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">
                    <i class="bi bi-shop"></i> Мой Магазин
                </h5>
                <p class="footer-text text-muted small">
                    Качественные товары по доступным ценам. Работаем с 2020 года и доставляем по всей России.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="social-icon" title="Telegram"><i class="bi bi-telegram"></i></a>
                    <a href="#" class="social-icon" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-icon" title="VK"><i class="bi bi-chat-fill"></i></a>
                    <a href="#" class="social-icon" title="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Колонка 2: Покупателям --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Покупателям</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="/delivery">Доставка и оплата</a></li>
                    <li><a href="/returns">Возврат товара</a></li>
                    <li><a href="/warranty">Гарантия</a></li>
                    <li><a href="/faq">Частые вопросы</a></li>
                    <li><a href="/reviews">Отзывы</a></li>
                </ul>
            </div>

            {{-- Колонка 3: Компания --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Компания</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="/about">О нас</a></li>
                    <li><a href="/contacts">Контакты</a></li>
                    <li><a href="/vacancies">Вакансии</a></li>
                    <li><a href="/partners">Партнёрам</a></li>
                    <li><a href="/privacy">Политика конфиденциальности</a></li>
                </ul>
            </div>

            {{-- Колонка 4: Контакты --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Контакты</h5>
                <ul class="footer-contacts list-unstyled">
                    <li>
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:+79991234567">+7 (999) 123-45-67</a>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:info@mymagazin.ru">info@mymagazin.ru</a>
                    </li>
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>г. Москва, ул. Примерная, д. 1</span>
                    </li>
                    <li>
                        <i class="bi bi-clock-fill"></i>
                        <span>Пн-Вс: 9:00 - 21:00</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Разделитель --}}
        <hr class="my-4 border-secondary">

        {{-- Нижняя часть: копирайт и доп. информация --}}
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 small text-muted">
                    © {{ date('Y') }} МойМагазин. Все права защищены.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <span class="small text-muted">
                    Принимаем к оплате:
                    <i class="bi bi-credit-card ms-1" title="Банковские карты"></i>
                    <i class="bi bi-wallet2 ms-1" title="Электронные кошельки"></i>
                    <i class="bi bi-cash-coin ms-1" title="Наличные при получении"></i>
                </span>
            </div>
        </div>
    </div>
</footer>