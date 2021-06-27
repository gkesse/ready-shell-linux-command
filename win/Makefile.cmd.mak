#================================================
# all
all:
#================================================
# git
git_status:
	@cd $(GPROJECT_PATH) && git status -u
git_push:
	@cd $(GPROJECT_PATH) && git pull && git add --all && git commit -m "Initial Commit" && git push -u origin main
git_push_o:
	@cd $(GPROJECT_PATH) && git add --all && git commit -m "Initial Commit" && git push -u origin main
git_push_all:
	@cd $(GPROJECT_PATH) && git add --all && git commit -m "Initial Commit" && git push -u --all
git_pull:
	@cd $(GPROJECT_PATH) && git pull
git_clone:
	@cd $(GPROJECT_ROOT) && git clone $(GGIT_URL) $(GGIT_NAME) 
git_branch_list:
	@cd $(GPROJECT_PATH) && git branch
git_branch_create:
	@cd $(GPROJECT_PATH) && git branch $(GGIT_BRANCH)
git_branch_checkout:
	@cd $(GPROJECT_PATH) && git checkout $(GGIT_BRANCH)
git_branch_push:
	@cd $(GPROJECT_PATH) && git pull && git add --all && git commit -m "Initial Commit" && git push -u origin $(GGIT_BRANCH)
git_branch_checkout_m:
	@cd $(GPROJECT_PATH) && git checkout main
#================================================
