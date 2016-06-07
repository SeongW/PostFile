package org.service;

import org.model.KcbEntity;
import java.util.List;
/**
 * Created by wujiacheng on 16/6/5.
 */
public interface KcService {
    //插入课程信息
    public void save(KcbEntity kc);
    //根据课程号删除课程信息
    public void delete(String kch);
    //修改课程信息
    public void update(KcbEntity kc);
    //根据课程号查找课程信息
    public KcbEntity find(String kch);
    //分页显示课程信息
    public List findAll(int pageNow,int pageSize);
    //查询一共多少条课程记录
    public int findKcSize();

}
