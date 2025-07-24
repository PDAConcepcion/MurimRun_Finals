<?php
function footer(array $customJs = []): void
{ ?>
    </main>
    <footer>
        <div class="footer-container">
            <div class="group-name">
                <h1>MurimRun</h1>
            </div>

            <?php if (!empty($customJs)) {
                foreach ($customJs as $jsFile) {
                    echo "<script src=\"{$jsFile}\"></script>\n";
                }
            } ?>

            <div class="members-container">
                <a href="">Rey Vincent Putian</a>
                <a href="">Patrick Concepcion</a>
                <a href="">William Andres</a>
                <a href="">Gabriel Camino</a>
            </div>

            <div class="copyright">
                <p>© 2022 MurimRun, All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="/assets/js/header.js"></script>

    </body>

    </html>
<?php } ?>