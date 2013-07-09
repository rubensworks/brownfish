DEBUG = False

BASE_DIR_LESS = bbv/themes/bootstrap/less/
BASE_DIR_LESS_BOOTSTRAP = bbv/protected/extensions/bootstrap/assets/less/
BASE_DIR_CSS = bbv/themes/bootstrap/css/
BASE_DIR_CSS_BOOTSTRAP = bbv/protected/extensions/bootstrap/assets/css/

ifeq ($(DEBUG),True)
    LESSC=lessc
else
    LESSC=lessc -x
endif

less:
	$(LESSC) ${BASE_DIR_LESS}styles.less > ${BASE_DIR_CSS}styles.css
	$(LESSC) ${BASE_DIR_LESS_BOOTSTRAP}bootstrap.less > ${BASE_DIR_CSS_BOOTSTRAP}bootstrap.css
	$(LESSC) ${BASE_DIR_LESS_BOOTSTRAP}responsive.less > ${BASE_DIR_CSS_BOOTSTRAP}bootstrap-responsive.css