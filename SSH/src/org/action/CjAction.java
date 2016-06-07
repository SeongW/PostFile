package org.action;

import com.opensymphony.xwork2.ActionContext;
import com.opensymphony.xwork2.ActionSupport;
import org.model.CjbEntity;
import org.model.CjbEntityPK;
import org.model.KcbEntity;
import org.service.CjService;
import org.service.KcService;
import org.service.XsService;
import org.tool.Pager;


import java.util.List;
import java.util.Map;

/**
 * Created by wujiacheng on 16/6/6.
 */
public class CjAction extends ActionSupport {
    private int pageNow=1;
    private int pageSize=8;
    private CjbEntity cj;
    private XsService xsService;
    private KcService kcService;
    private CjService cjService;
    public void setXsService(XsService xsService) {
        this.xsService = xsService;
    }
    public void setKcService(KcService kcService) {
        this.kcService = kcService;
    }
    public String execute() throws Exception {
        List list1=xsService.findAll(1, xsService.findXsSize());
        List list2=kcService.findAll(1, kcService.findKcSize());
        Map request=(Map) ActionContext.getContext().get("request");
        request.put("list1", list1);
        request.put("list2", list2);
        return SUCCESS;
    }
    public String xscjInfo()throws Exception{
        List list=cjService.findAllCj(this.getPageNow(), this.getPageSize());
        Map request=(Map)ActionContext.getContext().get("request");
        request.put("list",list);
        Pager page=new Pager(this.getPageNow(),cjService.findCjSize());
        System.out.println(cjService.findCjSize());
        request.put("page", page);
        return SUCCESS;
    }
    public String findXscj()throws Exception{
        List list=cjService.getXsCjList(cj.getId().getXh());
        if(list.size()>0){
            Map request=(Map)ActionContext.getContext().get("request");
            request.put("list",list);
            return SUCCESS;
        }else
            return ERROR;
    }
    public String addorupdateXscj()throws Exception{
        CjbEntity cj1 = null;
        CjbEntityPK cjId1=new CjbEntityPK();
        cjId1.setXh(cj.getId().getXh());
        cjId1.setKch(cj.getId().getKch());



        if(cjService.getXsCj(cj.getId().getXh(), cj.getId().getKch())==null){
            cj1 = new CjbEntity(cjId1);
            //cj1.setId(cjId1);
           // System.out.println("true-id:"+cj1.getId()+"\n");

        }else{
            cj1 = cjService.getXsCj(cj.getId().getXh(), cj.getId().getKch());
            //System.out.println("false-id:"+cj1.getId()+"\n");

        }

        KcbEntity kc1=kcService.find(cj.getId().getKch());
//        System.out.println("xf:"+kc1.getXf()+"\n");

        cj1.setCj(cj.getCj());
        if(cj.getCj()>60||cj.getCj()==60){
            cj1.setXf(kc1.getXf());
        }else
            cj1.setXf(0);

//        System.out.println("xh:"+cj1.getId().getXh()+"\n");
//        System.out.println("kch:"+cj1.getId().getKch()+"\n");
//        System.out.println("cj:"+cj1.getCj()+"\n");
//        System.out.println("xf:"+cj1.getXf()+"\n");

        cjService.saveorupdateCj(cj1);
        return SUCCESS;
    }
    public String deleteOneXscj()throws Exception{
        String xh=cj.getId().getXh();
        String kch=cj.getId().getKch();
        cjService.deleteCj(xh, kch);
        Map request=(Map)ActionContext.getContext().get("request");
        return SUCCESS;
    }
    public int getPageNow() {
        return pageNow;
    }
    public void setPageNow(int pageNow) {
        this.pageNow = pageNow;
    }
    public int getPageSize() {
        return pageSize;
    }
    public void setPageSize(int pageSize) {
        this.pageSize = pageSize;
    }
    public void setCjService(CjService cjService) {
        this.cjService = cjService;
    }
    public CjbEntity getCj() {
        return cj;
    }
    public void setCj(CjbEntity cj) {
        this.cj = cj;
    }

}
