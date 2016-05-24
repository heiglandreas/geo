
SCRIPT_PATH="$(pwd)"

# Install mkdocs and required extensions.
pip install --user mkdocs
pip install --user pymdown-extensions

# Conditionally install zf-mkdoc-theme.
#if [[ ! -d "zf-mkdoc-theme/theme" ]];then
#    echo "Downloading zf-mkdoc-theme..." ;
#    mkdir -p zf-mkdoc-theme ;
#    curl -s -L https://github.com/zendframework/zf-mkdoc-theme/releases/latest | egrep -o '/zendframework/zf-mkdoc-theme/archive/[0-9]*\.[0-9]*\.[0-9]*\.tar\.gz' | head -n1 | wget -O zf-mkdoc-theme.tgz --base=https://github.com/ -i - ;
#    (
#        cd zf-mkdoc-theme ;
#        tar xzf ../zf-mkdoc-theme.tgz --strip-components=1 ;
#    );
#    echo "Finished downloading and installing zf-mkdoc-theme" ;
#fi

exit 0;