DEBUG = False

BASE_DIR_LESS = bbv/themes/default/less/
BASE_DIR_LESS_BOOTSTRAP = bbv/protected/extensions/bootstrap/assets/less/
BASE_DIR_CSS = bbv/themes/default/css/
BASE_DIR_CSS_BOOTSTRAP = bbv/protected/extensions/bootstrap/assets/css/

BASE_DIR_TEST = bbv/protected/tests/
BASE_DIR_TEST_WFORM = bbv/protected/extensions/wform/tests/
TEST_CONFIG = phpunit.xml

ifeq ($(DEBUG),True)
    LESSC = lessc
else
    LESSC = lessc -x
endif

PHPUNIT = phpunit

less:
	$(LESSC) ${BASE_DIR_LESS}styles.less > ${BASE_DIR_CSS}styles.css
	$(LESSC) ${BASE_DIR_LESS_BOOTSTRAP}responsive.less > ${BASE_DIR_CSS_BOOTSTRAP}bootstrap-responsive.css
	$(LESSC) ${BASE_DIR_LESS_BOOTSTRAP}yii.less > ${BASE_DIR_CSS_BOOTSTRAP}yii.css

test-all: test-app test-extension-wform

test-app:
	$(PHPUNIT) --configuration ${BASE_DIR_TEST}${TEST_CONFIG} ${BASE_DIR_TEST}

test-extension-wform:
	$(PHPUNIT) --configuration ${BASE_DIR_TEST_WFORM}${TEST_CONFIG} ${BASE_DIR_TEST_WFORM}

