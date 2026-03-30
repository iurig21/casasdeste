<x-layout>
    <section class="acabamentos-page">

        <section class="acabamentos-hero">
            <img src="{{ asset('imagens/acabamentos-hero.webp') }}" alt="Acabamentos Casas D'Este" class="acabamentos-hero__image" fetchpriority="high">
        </section>

        <section class="acabamentos-intro">
            <div class="acabamentos-intro__heading">
                <h1 class="lazy-text"><span class="acabamentos-intro__h1-line">Materiais selecionados</span><br><span class="acabamentos-intro__h1-line acabamentos-intro__h1-line--sub">para conforto e durabilidade</span></h1>
            </div>
            <p class="acabamentos-intro__text lazy-text" data-delay="100">
                Os acabamentos foram definidos para garantir elegância, resistência e personalização, permitindo ao cliente escolher cores e pequenos detalhes dentro dos valores definidos.
            </p>
        </section>

        <section class="acabamentos-specs lazy-section">
            <div class="acabamentos-specs__left">
                <article class="acabamentos-spec">
                    <h2 class="lazy-text lazy-text--left">Pavimentos</h2>
                    <ul class="lazy-text lazy-text--left" data-delay="80">
                        <li>Pavimento flutuante AC6 (FINSA ou equivalente) nas zonas secas</li>
                        <li>Pavimento cerâmico nas zonas húmidas e varandas</li>
                        <li>Aplicação sobre tela acústica para maior conforto</li>
                    </ul>
                </article>

                <article class="acabamentos-spec">
                    <h2 class="lazy-text lazy-text--left" data-delay="120">Carpintarias</h2>
                    <ul class="lazy-text lazy-text--left" data-delay="200">
                        <li>Portas lacadas até ao teto</li>
                        <li>Roupeiros interiores em melamina imitação nogueira</li>
                        <li>Rodapés lacados (45mm)</li>
                        <li>Ferragens EMUCA e JNF</li>
                    </ul>
                </article>

                <article class="acabamentos-spec">
                    <h2 class="lazy-text lazy-text--left" data-delay="220">Iluminação</h2>
                    <ul class="lazy-text lazy-text--left" data-delay="300">
                        <li>Estudo luminotécnico incluído</li>
                        <li>Iluminação até 2.500€ PVP</li>
                        <li>Tetos preparados para soluções modernas e embutidas</li>
                    </ul>
                </article>

                <article class="acabamentos-spec">
                    <h2 class="lazy-text lazy-text--left" data-delay="320">Paredes e Tetos</h2>
                    <ul class="lazy-text lazy-text--left" data-delay="400">
                        <li>Paredes em gesso projetado, pintadas com primário e duas demãos</li>
                        <li>Tetos falsos em gesso cartonado (hidrófugo nas zonas húmidas)</li>
                        <li>Revestimentos cerâmicos até 20€/m² nas instalações sanitárias</li>
                        <li>Painéis decorativos imitação nogueira na sala e suíte</li>
                    </ul>
                </article>
            </div>

            <div class="acabamentos-specs__right max-[860px]:w-full max-[860px]:px-[14px]">
                <img src="{{ asset('imagens/acabamentos-interior-right.webp') }}" alt="Interior acabamentos" class="block w-full" loading="lazy">
            </div>
        </section>

        <section class="acabamentos-details lazy-section">
            <div class="acabamentos-details__row">
                <div class="acabamentos-details__images max-[860px]:w-full max-[860px]:px-[14px]">
                    <div class="acabamentos-details__image">
                        <img src="{{ asset('imagens/interna1.webp') }}" alt="Cozinha" class="block w-full" loading="lazy">
                    </div>
                    <div class="acabamentos-details__image">
                        <img src="{{ asset('imagens/acabamentos-quarto.webp') }}" alt="Caixilharia e exterior" class="block w-full" loading="lazy">
                    </div>
                    <div class="acabamentos-details__image">
                        <img src="{{ asset('imagens/acabamentos-wc.webp') }}" alt="Instalações sanitárias" class="block w-full" loading="lazy">
                    </div>
                </div>
                <div class="acabamentos-details__content">
                    <div class="acabamentos-details__content-inner">
                        <article class="acabamentos-spec">
                            <h2 class="lazy-text lazy-text--right">Cozinha</h2>
                            <ul class="lazy-text lazy-text--right" data-delay="100">
                                <li>Mobiliário em MDF hidrófugo lacado (cor à escolha)</li>
                                <li>Ilha central lacada</li>
                                <li>Sistema de gavetas com fecho suave (slow-motion)</li>
                                <li>Tampo e contra-tampo até 400€/m²</li>
                                <li>Revestimento cerâmico retificado 45x90 cm</li>
                                <li>Lava-loiça e torneira incluídos</li>
                            </ul>
                        </article>

                        <article class="acabamentos-spec">
                            <h2 class="lazy-text lazy-text--right" data-delay="80">Caixilharia e Exterior</h2>
                            <ul class="lazy-text lazy-text--right" data-delay="140">
                                <li>Alumínio com rutura térmica, preto mate</li>
                                <li>Vidro duplo GuardianSun</li>
                                <li>Estores elétricos com isolamento térmico</li>
                                <li>Guardas em vidro</li>
                                <li>Portão seccionado automático</li>
                            </ul>
                        </article>

                        <article class="acabamentos-spec">
                            <h2 class="lazy-text lazy-text--right" data-delay="80">Instalações&nbsp;Sanitárias</h2>
                            <ul class="lazy-text lazy-text--right" data-delay="140">
                                <li>Louças suspensas com sistema kombifix slim</li>
                                <li>Sanitas com tampo soft close</li>
                                <li>Torneiras mono comando (acabamento preto)</li>
                                <li>Bases de duche modernas</li>
                                <li>Pios ovais até 140€</li>
                                <li>Placas de descarga em preto mate</li>
                            </ul>
                        </article>

                        <article class="acabamentos-spec">
                            <h2 class="lazy-text lazy-text--right" data-delay="80">Personalização</h2>
                            <p class="lazy-text lazy-text--right" data-delay="140">
                                Os acabamentos seguem as imagens 3D do projeto, permitindo ao cliente selecionar cores e pequenos ajustes dentro dos parâmetros definidos, garantindo uma casa personalizada sem comprometer qualidade e coerência arquitetónica.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

    </section>
</x-layout>
