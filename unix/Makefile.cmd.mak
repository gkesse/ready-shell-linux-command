#================================================
# cmd
cmd_chmod:
	@sudo chmod -R 777 $(GPROJECT_PATH) 
#================================================
# apache
apa_status:
	@sudo service apache2 status
apa_restart:
	@sudo service apache2 restart
apa_rewrite:
	@sudo a2enmod rewrite
#================================================
# git
git_install:
	@sudo apt install -y git
git_config:
	@git config --global user.name "Gerard KESSE"
	@git config --global user.email "tiakagerard@hotmail.com"
	@git config --global core.editor "vim"
	@git config --list
git_store:
	@git config credential.helper store
git_status:
	@cd $(GPROJECT_PATH) && git status -u
git_push:
	@cd $(GPROJECT_PATH) && git pull && git add --all && git commit -m "Initial Commit" && git push -u origin main
git_push_o:
	@cd $(GPROJECT_PATH) && git add --all && git commit -m "Initial Commit" && git push -u origin main
git_pull:
	@cd $(GPROJECT_PATH) && git pull
	@sudo chmod -R 777 $(GPROJECT_PATH) 
git_clone:
	@cd $(GPROJECT_ROOT) && git clone $(GGIT_URL) $(GGIT_NAME) 
#================================================
