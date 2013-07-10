DEBUG = False

BASE_DIR_LESS = bbv/themes/default/less/
BASE_DIR_LESS_BOOTSTRAP = bbv/protected/extensions/bootstrap/assets/less/
BASE_DIR_CSS = bbv/themes/default/css/
BASE_DIR_CSS_BOOTSTRAP = bbv/protected/extensions/bootstrap/assets/css/

ifeq ($(DEBUG),True)
    LESSC=lessc
else
    LESSC=lessc -x
endif

less:
	$(LESSC) ${BASE_DIR_LESS}styles.less > ${BASE_DIR_CSS}styles.css
	$(LESSC) ${BASE_DIR_LESS_BOOTSTRAP}responsive.less > ${BASE_DIR_CSS_BOOTSTRAP}bootstrap-responsive.css
	$(LESSC) ${BASE_DIR_LESS_BOOTSTRAP}yii.less > ${BASE_DIR_CSS_BOOTSTRAP}yii.css