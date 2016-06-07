package org.action;

import com.opensymphony.xwork2.ActionContext;
import com.opensymphony.xwork2.ActionSupport;
import org.model.DlbEntity;
import org.service.DlService;
import org.service.DlServiceImp;

import java.util.Map;

/**
 * Created by wujiacheng on 16/5/31.
 */
public class loginAction extends ActionSupport
{
    private DlServiceImp dlService;
    private DlbEntity dlbEntity;

    public DlServiceImp getDlService() {
        return dlService;
    }

    public void setDlService(DlServiceImp dlService) {
        this.dlService = dlService;
    }

    public DlbEntity getDlbEntity() {
        return dlbEntity;
    }

    public void setDlbEntity(DlbEntity dlbEntity) {
        this.dlbEntity = dlbEntity;
    }

    public String execute() throws Exception{
        DlbEntity user = dlService.find(dlbEntity.getXh(),dlbEntity.getKl());
        if(user != null){
            Map session = (Map) ActionContext.getContext().getSession();
            session.put("user", user);
            return SUCCESS;
        } else {
            return ERROR;
        }
    }
}
