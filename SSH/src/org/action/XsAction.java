package org.action;

import com.opensymphony.xwork2.ActionSupport;
import java.util.List;
import java.io.File;
import java.util.Map;

import org.springframework.mock.web.MockHttpServletResponse;
import org.tool.Pager;
import java.io.FileInputStream;
import org.apache.struts2.ServletActionContext;
import org.model.XsbEntity;
import org.service.XsService;
import org.service.ZyService;
import com.opensymphony.xwork2.ActionContext;


/**
 * Created by wujiacheng on 16/6/5.
 */
public class XsAction extends ActionSupport {
    private int pageNow=1;
    private int pageSize=8;
    private File zpfile;
    //存放专业集合
    private List list;
    public void setList(List list) {
        this.list = list;
    }
    public List getList(){
        return zyService.getAll();//返回专业集合
    }
    public File getZpfile() {
        return zpfile;
    }
    public void setZpfile(File zpfile) {
        this.zpfile = zpfile;
    }
    private XsbEntity xs;
    private XsService xsService;
    private ZyService zyService;
    public void setZyService(ZyService zyService) {
        this.zyService = zyService;
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
    public String execute() throws Exception {
        System.out.println(this.getPageNow());
        List list=xsService.findAll(pageNow,pageSize);
        Map request=(Map)ActionContext.getContext().get("request");
        Pager page=new Pager(getPageNow(),xsService.findXsSize());
        request.put("list", list);
        request.put("page", page);
        return SUCCESS;
    }
    public String addXs() throws Exception{
        XsbEntity stu=new XsbEntity();
        String xh1=xs.getXh();
        if(xsService.find(xh1)!=null){
            return ERROR;
        }
        stu.setXh(xs.getXh());
        stu.setXm(xs.getXm());
        stu.setXb(xs.getXb());
        stu.setCssj(xs.getCssj());
        System.out.println(xs.getCssj());
        stu.setZxf(xs.getZxf());
        stu.setBz(xs.getBz());
        stu.setZyb(zyService.getOneZy(xs.getZyb().getId()));
        stu.setZp(null);
//        if(this.getZpfile()!=null){
//            FileInputStream fis=new FileInputStream(this.getZpfile());
//            byte[] buffer=new byte[fis.available()];
//            fis.read(buffer);
//            stu.setZp(buffer);
//        }

        xsService.save(stu);
        return SUCCESS;
    }
    public String deleteXs() throws Exception{
        String xh=xs.getXh();
        xsService.delete(xh);
        return SUCCESS;
    }
    public String updateXsView()throws Exception{
        String xh=xs.getXh();
        XsbEntity xsInfo=xsService.find(xh);
        List zys=zyService.getAll();
        Map request=(Map)ActionContext.getContext().get("request");
        request.put("xsInfo", xsInfo);
        request.put("zys", zys);
        return SUCCESS;
    }
    public String updateXs()throws Exception{
        XsbEntity xs1=xsService.find(xs.getXh());
        xs1.setXm(xs.getXm());
        xs1.setXb(xs.getXb());
        xs1.setZyb(zyService.getOneZy(xs.getZyb().getId()));
        xs1.setCssj(xs.getCssj());
        xs1.setZxf(xs.getZxf());
        xs1.setBz(xs.getBz());
        xs1.setZp(null);
//        if(this.getZpfile()!=null){
//            FileInputStream fis=new FileInputStream(this.getZpfile());
//            byte[] buffer=new byte[fis.available()];
//            fis.read(buffer);
//            xs1.setZp(buffer);
//        }
        Map request=(Map)ActionContext.getContext().get("request");
        xsService.update(xs1);
        return SUCCESS;
    }
    public String getImage() throws Exception{
//        MockHttpServletResponse response = ServletActionContext.getResponse();
//        String xh=xs.getXh();
//        XsbEntity xs3=xsService.find(xh);
//        byte[] img = xs3.getZp();
//        response.setContentType("image/jpeg");
//        ServletOutputStream os = response.getOutputStream();
//        if ( img != null && img.length != 0 )
//        {
//            for (int i = 0; i < img.length; i++)
//            {
//                os.write(img[i]);
//            }
//            os.flush();
//        }
        return NONE;
    }
    public String findXs()throws Exception{
        String xh=xs.getXh();
        XsbEntity stu2=xsService.find(xh);
        Map request=(Map)ActionContext.getContext().get("request");
        request.put("xs", stu2);
        return SUCCESS;
    }
    public String addXsView()throws Exception{
        return	SUCCESS;
    }
    public XsbEntity getXs() {
        return xs;
    }
    public void setXs(XsbEntity xs) {
        this.xs = xs;
    }
    public XsService getXsService() {
        return xsService;
    }
    public void setXsService(XsService xsService) {
        this.xsService = xsService;
    }

}
